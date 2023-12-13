import Cookie from "./Cookie.js";
import ajax from "./ajax.js";
import Notification from "./Notification.js";

async function fetchData(endpoint, storageKey) {
  try {
    const response = await ajax(`${window.location.href}${endpoint}`);
    const data = await response.json();
    localStorage.setItem(storageKey, JSON.stringify(data));
    console.log(data);
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
    annotations: {
      yaxis: [
        {
          // Recommended sleep duration
          y: 8,
          y2: 20,
          borderColor: "#00E396",
          fillColor: "#00a2ff",
          label: {
            borderColor: "#00a2ff",
            style: {
              color: "#fff",
              background: "#00a2ff",
            },
            text: "Recommended: 2 to 5 liters",
          },
        },
      ],
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
      labels: {
        formatter: (values, opts) => {
          // const nepaliDate = NepaliFunctions.ParseDate(value);
          if (values) {
            const [y, m, d] = values.split("/");
            return `${NepaliFunctions.GetBsMonth(m - 1)} ${d}`;
          }
        },
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
    document.querySelector("#water"),
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
 *       Do for sleepData
 *
 */
async function fetchDataAndRender() {
  const [exerciseData, sleepData, waterData] = await Promise.all([
    fetchData("/add/daily-exercise/data", "Exercise"),
    fetchData("/add/quality-sleep/data", "Sleep"),
    fetchData("/add/stay-hydrated/data", "Water"),
    fetchData("/notification", "Reminder"),
  ]);
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
  function isObjEmpty(objectName) {
    return (
      objectName &&
      Object.keys(objectName).length === 0 &&
      objectName.constructor === Object
    );
  }

  if (
    isObjEmpty(exerciseData) &&
    isObjEmpty(waterData) &&
    isObjEmpty(sleepData)
  ) {
    new Notification(document.querySelector(".notification")).create(
      `🎉 Welcome aboard, <span class="text-secondary">${
        Cookie.getObj("user").first_name
      }</span> 🎉`,
      `To get started, kindly <a class="text-tertiary" href="${window.location.href}/add">save your data</a> in the <span class="text-secondary italic">Add page</span> for it to appear on the dashboard.
       <br />
       <br />
       Also navigate to <span class="text-secondary italic">Profile page</span>, and please <a class="text-tertiary" href="./profile">insert your age, height, and weight</a> to get the most accurate health tracking stas.`,
      20,
    );
  }
  if (!isObjEmpty(exerciseData)) {
    /* Exercise Bar Chart */
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
      title: {
        text: "Exercise",
        align: "Center",
        offsetY: 25,
        offsetX: 20,
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
          formatter: (values, opts) => {
            // const nepaliDate = NepaliFunctions.ParseDate(value);
            if (values) {
              const [y, m, d] = values.split("/");
              return `${NepaliFunctions.GetBsMonth(m - 1)} ${d}`;
            }
          },
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
      document.querySelector("#exercise__bar-chart"),
      options,
    );
    chart.render();
    /* Exercise Radar Chart */
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
        // text: "Average Exercise Duration : Minutes per Activity",
        text: "Average Exercise Duration (Minutes)",
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
      document.querySelector("#exercise__radar-chart"),
      radarOptions,
    ).render();
  }
  if (!isObjEmpty(waterData)) {
    const [waterDates, waterTargets, waterIntaked] = convertAndSort(waterData);
    renderChart(waterDates, waterTargets, waterIntaked);
  }
  if (!isObjEmpty(sleepData)) {
    // Call the function for sleepData
    const [sleepDates, sleepBed, sleepWakeup, sleepDuration] =
      convertAndSort(sleepData);
    const formattedSleepBed = sleepBed.map(formatTime);
    const formattedSleepWakeup = sleepWakeup.map(formatTime);
    const formattedSleepDuration = sleepDuration.map(formatTime);
    function timeToMinutes(time) {
      const [hours, minutes] = time.split(":").map(Number);
      return hours * 60 + minutes;
    }
    function minutesToTime(minutes) {
      const hours = Math.floor(minutes / 60);
      const remainingMinutes = minutes % 60;
      const formattedHours = String(hours).padStart(2, "0");
      const formattedMinutes = String(remainingMinutes).padStart(2, "0");
      return `${formattedHours}:${formattedMinutes}`;
    }
    function minutesToTimeWithHoursAndMinutes(minutes) {
      const hours = Math.floor(minutes / 60);
      const remainingMinutes = minutes % 60;

      const hoursString = hours > 0 ? `${hours}hr` : "";
      const minutesString =
        remainingMinutes > 0 ? `${remainingMinutes}min` : "";

      return `${hoursString} ${minutesString}`.trim();
    }
    // console.log(
    //   timeToMinutes(formattedSleepWakeup[0]),
    //   formattedSleepDuration.map(timeToMinutes),
    //   timeToMinutes(formattedSleepBed[0]),
    // );
    // var optionsCircle4 = {
    //   chart: {
    //     type: "radialBar",
    //     height: 350,
    //     width: 380,
    //   },
    //   plotOptions: {
    //     radialBar: {
    //       size: undefined,
    //       inverseOrder: true,
    //       hollow: {
    //         margin: 5,
    //         // size: "48%",
    //         background: "transparent",
    //       },
    //       track: {
    //         show: false,
    //       },
    //       startAngle: -180,
    //       endAngle: 180,
    //     },
    //   },
    //   stroke: {
    //     lineCap: "round",
    //   },
    //   series: [
    //     timeToMinutes(formattedSleepWakeup[0]),
    //     timeToMinutes(formattedSleepDuration[0]),
    //     timeToMinutes(formattedSleepBed[0]),
    //   ],
    //   labels: ["Wakeup Time", "Sleep Duration", "Bed Time"],
    //   legend: {
    //     show: true,
    //     floating: true,
    //     position: "right",
    //     offsetX: 20,
    //     offsetY: 240,
    //   },
    // };
    var dates = [];
    var spikes = [5, -5, 3, -3, 8, -8];
    for (var i = 0; i < sleepDates.length; i++) {
      var innerArr = [
        // NepaliFunctions.BS2AD(sleepDates[i]),
        // sleepDates[i],
        new Date(NepaliFunctions.BS2AD(sleepDates[i], "YYYY/MM/DD")).getTime(),
        timeToMinutes(formattedSleepDuration[i]),
      ];
      dates.push(innerArr);
    }
    console.log(dates);
    console.log(formattedSleepDuration);
    var options = {
      series: [
        {
          name: "Sleep Duration",
          data: dates,
        },
      ],
      chart: {
        type: "area",
        stacked: false,
        height: 350,
        zoom: {
          type: "x",
          enabled: true,
          autoScaleYaxis: true,
        },
        toolbar: {
          autoSelected: "zoom",
        },
      },
      annotations: {
        yaxis: [
          {
            // Recommended sleep duration
            y: 480,
            borderColor: "#00E396",
            label: {
              borderColor: "#00E396",
              style: {
                color: "#fff",
                background: "#00E396",
              },
              text: "Recommended: 8 hours",
            },
          },
        ],
      },
      dataLabels: {
        enabled: false,
      },
      markers: {
        size: 0,
      },
      title: {
        text: "Sleep Duration",
        align: "Center",
        offsetY: 25,
        offsetX: 20,
      },
      fill: {
        type: "gradient",
        gradient: {
          shadeIntensity: 1,
          inverseColors: false,
          opacityFrom: 0.5,
          opacityTo: 0,
          stops: [0, 90, 100],
        },
      },
      yaxis: {
        labels: {
          formatter: function (val) {
            return minutesToTime(val);
          },
        },
        title: {
          text: "Time",
        },
      },
      xaxis: {
        type: "datetime",
        labels: {
          formatter: function (value) {
            let nepaliDate = NepaliFunctions.AD2BS(
              new Date(value).toISOString().split("T")[0],
              "YYYY-MM-DD",
              "YYYY/MM/DD",
            );
            if (nepaliDate) {
              const [y, m, d] = nepaliDate.split("/");
              return `${NepaliFunctions.GetBsMonth(m - 1)} ${d}`;
            }
          },
        },
      },
      tooltip: {
        shared: false,
        y: {
          formatter: function (val, a, b) {
            return minutesToTimeWithHoursAndMinutes(val);
          },
        },
      },
    };

    var chart = new ApexCharts(document.querySelector("#sleep"), options);
    chart.render();
  }
}
fetchDataAndRender();
