import ajax from "./ajax.js";

async function fetchData(endpoint, storageKey) {
  try {
    const response = await ajax(`${window.location.href}${endpoint}`);
    const data = await response.json();
    localStorage.setItem(storageKey, JSON.stringify(data));
    return data;
  } catch (error) {
    console.error(`Error setting ${storageKey} data:`, error);
    return null;
  }
}

function renderChart(dates, targets, intaked) {
  const optionsLine = {
    chart: {
      height: 400,
      type: "line",
      zoom: {
        type: "x",
        enabled: true,
        autoScaleYaxis: true,
      },
      fill: {
        type: "gradient",
        colors: ["#1A73E8", "#B32824"],
        gradient: {
          shadeIntensity: 1,
          inverseColors: false,
          opacityFrom: 1,
          opacityTo: 0.5,
          stops: [0, 10, 50],
        },
      },
    },
    stroke: {
      curve: "smooth",
      width: 2,
    },
    series: [
      {
        name: "Intaked",
        data: intaked,
      },
      {
        name: "Target",
        data: targets,
      },
    ],
    title: {
      text: "Water",
      align: "Center",
      offsetY: 25,
      offsetX: 20,
    },
    markers: {
      size: 6,
      strokeWidth: 0,
      hover: {
        size: 9,
      },
    },
    grid: {
      show: true,
      padding: {
        bottom: 0,
      },
    },
    labels: dates,
    xaxis: {
      tickPlacement: "on",
      tooltip: {
        enabled: false,
      },
    },
    yaxis: {
      title: {
        text: "Glasses (1 Glass = 250 ml)",
      },
      min: 0,
    },
    legend: {
      position: "top",
      horizontalAlign: "right",
      offsetY: -20,
    },
    grid: {
      row: {
        colors: ["#fff", "#f2f2f2"],
      },
    },
  };

  const chartLine = new ApexCharts(
    document.querySelector("#stay-hydrated"),
    optionsLine,
  );
  chartLine.render();

  console.log("Rendering chart with data");
}
/**
 * TODO: If waterData && exerciseData && sleepData then show data else print loading
 *
 *
 *       If !waterData.length && !sleepData.length && !exerciseData.length
 *          Show: Welcome user for first login
 *       Else if any of the waterData, sleepData or exerciseData are empty dont show any chart
 *
 */
async function fetchDataAndRender() {
  const [exerciseData, sleepData, waterData] = await Promise.all([
    fetchData("/add/daily-exercise/data", "Exercise"),
    fetchData("/add/quality-sleep/data", "Sleep"),
    fetchData("/add/stay-hydrated/data", "Water"),
  ]);
  /*   if (!waterData.length && !sleepData.length && !exerciseData.length) {
    console.log(
      "Welcome USER.Please insert data in Add section to show in the dashboard",
    );
  } else */ if (waterData && exerciseData && sleepData) {
    function convertAndSort(obj) {
      const dates = Object.keys(obj).sort();
      const dataArrays = Object.keys(obj[dates[0]]).map(key =>
        dates.map(date => obj[date][key]),
      );

      return [dates, ...dataArrays];
    }
    function formatTime(timeObj) {
      return `${timeObj.hour}:${timeObj.minute}`;
    }
    const [waterDates, waterTargets, waterIntaked] = convertAndSort(waterData);
    renderChart(waterDates, waterTargets, waterIntaked);

    // Call the function for sleepData
    const [sleepDates, sleepBed, sleepWakeup, sleepDuration] =
      convertAndSort(sleepData);
    const formattedSleepBed = sleepBed.map(formatTime);
    const formattedSleepWakeup = sleepWakeup.map(formatTime);
    const formattedSleepDuration = sleepDuration.map(formatTime);

    const [exerciseDates, exerciseNames, exerciseTargets, exerciseActual] =
      convertAndSort(exerciseData);
    console.log(convertAndSort(exerciseData));

    const exerciseSeries = [
      {
        name: "Actual",
        data: exerciseDates.map((date, index) => {
          const targetFulfilled =
            exerciseActual[index] >= exerciseTargets[index];
          return {
            x: date,
            y: exerciseActual[index],
            goals: [
              {
                name: "Expected",
                value: exerciseTargets[index],
                strokeHeight: targetFulfilled ? 10 : 5,
                strokeWidth: targetFulfilled ? 0 : 10,
                strokeDashArray: 2,
                strokeLineCap: targetFulfilled ? "round" : "",
                // strokeLineCap: "round",
                strokeColor: "hsl(164 95% 43%)",
              },
            ],
          };
        }),
      },
    ];
    var options = {
      series: exerciseSeries,
      chart: {
        height: 400,
        type: "bar",
      },
      plotOptions: {
        bar: {
          borderRadius: 10,
          columnWidth: "50%",
        },
      },
      zoom: {
        type: "x",
        enabled: true,
        autoScaleYaxis: true,
      },
      stroke: {
        width: 1,
      },

      grid: {
        row: {
          colors: ["#fff", "#f2f2f2"],
        },
      },
      xaxis: {
        labels: {
          rotate: -45,
        },
        tickPlacement: "on",
      },
      yaxis: {
        title: {
          text: "Minutes",
        },
      },
      tooltip: {
        x: {
          formatter: (val, opt) => {
            const exerciseName = exerciseNames[opt.dataPointIndex];
            return `Exercise: ${
              exerciseName.charAt(0).toUpperCase() + exerciseName.slice(1)
            }`;
          },
        },
      },
    };
    var chart = new ApexCharts(
      document.querySelector("#daily-exercise__bar-chart"),
      options,
    );
    chart.render();

    /* New radar */
    function calculateExerciseStats(data) {
      const exerciseStats = {};

      for (const date in data) {
        const { name, target, actual } = data[date];

        if (!exerciseStats[name]) {
          exerciseStats[name] = { totalTarget: 0, totalActual: 0, count: 0 };
        }

        exerciseStats[name].totalTarget += target;
        exerciseStats[name].totalActual += actual;
        exerciseStats[name].count += 1;
      }

      const averageStats = {};

      for (const exerciseName in exerciseStats) {
        const { totalTarget, totalActual, count } = exerciseStats[exerciseName];
        const averageTarget = totalTarget / count;
        const averageActual = totalActual / count;
        averageStats[exerciseName] = { averageTarget, averageActual };
      }

      return averageStats;
    }

    const averageStats = calculateExerciseStats(exerciseData);
    const [exerciseRadarNames, exerciseAvgTargets, exerciseAvgActual] =
      convertAndSort(averageStats);

    console.log("Distinct Exercises:", averageStats, exerciseRadarNames);

    const radarOptions = {
      series: [
        { name: "Target", data: exerciseAvgTargets },
        { name: "Actual", data: exerciseAvgActual },
      ],
      chart: {
        height: 400,
        type: "radar",
        dropShadow: { enabled: true, blur: 1, left: 1, top: 1 },
      },
      title: {
        text: "Average Exercise Duration : Minutes per Activity",
        align: "center",
        offsetY: 25,
        offsetX: 20,
      },
      stroke: { width: 2 },
      fill: { opacity: 0.1 },
      markers: { size: 0 },
      xaxis: { categories: exerciseRadarNames },
    };

    new ApexCharts(
      document.querySelector("#daily-exercise__radar-chart"),
      radarOptions,
    ).render();
  } else {
    console.log("Loading...");
  }
}

fetchDataAndRender();
