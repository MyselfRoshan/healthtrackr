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
  const maxToDisplay = Math.max(...targets.concat(intaked));
  console.log(dates, targets, intaked);

  const optionsLine = {
    chart: {
      height: 328,
      type: "line",
      zoom: {
        enabled: true,
      },
      dropShadow: {
        enabled: true,
        top: 3,
        left: 2,
        blur: 4,
        opacity: 1,
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
      tooltip: {
        enabled: false,
      },
    },
    yaxis: {
      title: {
        text: "Glasses (1 Glass = 250 ml)",
      },
      min: 0,
      max: maxToDisplay,
    },
    legend: {
      position: "top",
      horizontalAlign: "right",
      offsetY: -20,
    },
  };

  const chartLine = new ApexCharts(
    document.querySelector("#stay-hydrated"),
    optionsLine,
  );
  chartLine.render();

  console.log("Rendering chart with data");
}

async function fetchDataAndRender() {
  const [exerciseData, sleepData, waterData] = await Promise.all([
    fetchData("/add/daily-exercise/data", "Exercise"),
    fetchData("/add/quality-sleep/data", "Sleep"),
    fetchData("/add/stay-hydrated/data", "Water"),
  ]);

  if (waterData && exerciseData && sleepData) {
    const dates = Object.keys(waterData).sort();
    const targets = dates.map(date => waterData[date].target);
    const intaked = dates.map(date => waterData[date].intaked);
    renderChart(dates, targets, intaked);

    // var options = {
    //   series: [
    //     {
    //       name: "Bob",
    //       data: [
    //         {
    //           x: "Design",
    //           y: [
    //             new Date("2019-03-05").getTime(),
    //             new Date("2019-03-08").getTime(),
    //           ],
    //         },
    //         {
    //           x: "Code",
    //           y: [
    //             new Date("2019-03-08").getTime(),
    //             new Date("2019-03-11").getTime(),
    //           ],
    //         },
    //         {
    //           x: "Test",
    //           y: [
    //             new Date("2019-03-11").getTime(),
    //             new Date("2019-03-16").getTime(),
    //           ],
    //         },
    //       ],
    //     },
    //     {
    //       name: "Joe",
    //       data: [
    //         {
    //           x: "Design",
    //           y: [
    //             new Date("2019-03-02").getTime(),
    //             new Date("2019-03-05").getTime(),
    //           ],
    //         },
    //         {
    //           x: "Code",
    //           y: [
    //             new Date("2019-03-06").getTime(),
    //             new Date("2019-03-09").getTime(),
    //           ],
    //         },
    //         {
    //           x: "Test",
    //           y: [
    //             new Date("2019-03-10").getTime(),
    //             new Date("2019-03-19").getTime(),
    //           ],
    //         },
    //       ],
    //     },
    //   ],
    //   chart: {
    //     height: 350,
    //     type: "rangeBar",
    //   },
    //   plotOptions: {
    //     bar: {
    //       horizontal: true,
    //     },
    //   },
    //   dataLabels: {
    //     enabled: true,
    //     formatter: function (val) {
    //       var a = new Date(val[0]);
    //       var b = new Date(val[1]);

    //       var timeDiff = Math.abs(b.getTime() - a.getTime());
    //       var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));

    //       return diffDays + (diffDays > 1 ? " days" : " day");
    //     },
    //   },
    //   fill: {
    //     type: "gradient",
    //     gradient: {
    //       shade: "light",
    //       type: "vertical",
    //       shadeIntensity: 0.25,
    //       gradientToColors: undefined,
    //       inverseColors: true,
    //       opacityFrom: 1,
    //       opacityTo: 1,
    //       stops: [50, 0, 100, 100],
    //     },
    //   },
    //   xaxis: {
    //     type: "datetime",
    //   },
    //   legend: {
    //     position: "top",
    //   },
    // };

    // var chart = new ApexCharts(
    //   document.querySelector("#quality-sleep"),
    //   options,
    // );
    // chart.render();
    /* First attempt */
    // function formatSleepData(sleepData) {
    //   const seriesData = [];

    //   Object.entries(sleepData).forEach(([date, sleepEntry]) => {
    //     const bedTime = new Date(
    //       `${date} ${sleepEntry.bed.hour}:${sleepEntry.bed.minute}`,
    //     );
    //     const wakeupTime = new Date(
    //       `${date} ${sleepEntry.wakeup.hour}:${sleepEntry.wakeup.minute}`,
    //     );

    //     seriesData.push({
    //       x: date,
    //       y: [bedTime.getTime(), wakeupTime.getTime()],
    //     });
    //   });

    //   return [{ name: "Sleep", data: seriesData }];
    // }

    // // Format the sleep data for ApexCharts
    // const apexChartSeries = formatSleepData(sleepData);

    // // ApexCharts options
    // const options = {
    //   series: apexChartSeries,
    //   chart: {
    //     height: 350,
    //     type: "rangeBar",
    //   },
    //   plotOptions: {
    //     bar: {
    //       horizontal: true,
    //     },
    //   },
    //   dataLabels: {
    //     enabled: true,
    //     formatter: function (val) {
    //       var a = new Date(val[0]);
    //       var b = new Date(val[1]);

    //       var timeDiff = Math.abs(b.getTime() - a.getTime());
    //       var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));

    //       return diffDays + (diffDays > 1 ? " days" : " day");
    //     },
    //   },
    //   fill: {
    //     type: "gradient",
    //     gradient: {
    //       shade: "light",
    //       type: "vertical",
    //       shadeIntensity: 0.25,
    //       gradientToColors: undefined,
    //       inverseColors: true,
    //       opacityFrom: 1,
    //       opacityTo: 1,
    //       stops: [50, 0, 100, 100],
    //     },
    //   },
    //   xaxis: {
    //     type: "datetime",
    //   },
    //   legend: {
    //     position: "top",
    //   },
    // };

    // // Initialize and render the ApexCharts
    // const chart = new ApexCharts(
    //   document.querySelector("#quality-sleep"),
    //   options,
    // );
    // chart.render();

    /* Second Attempt */

    let durationHours;
    let durationMinutes;
    function formatSleepData(sleepData) {
      const seriesData = [];

      Object.entries(sleepData).forEach(([dateBS, entry]) => {
        const date = NepaliFunctions.BS2AD(dateBS, "YYYY-MM-DD");
        console.log(date);
        const bedTime = new Date(
          `${date} ${entry.bed.hour}:${entry.bed.minute}`,
        );
        const wakeupTime = new Date(
          `${date} ${entry.wakeup.hour}:${entry.wakeup.minute}`,
        );
        durationHours = parseInt(entry.duration.hour);
        durationMinutes = parseInt(entry.duration.minute);

        seriesData.push({
          x: `${entry.bed.hour}:${entry.bed.minute}`,
          y: [bedTime.getTime(), wakeupTime.getTime()],
        });
      });

      return [{ name: "Sleep", data: seriesData }];
    }

    // Format the sleep data for ApexCharts
    const apexChartSeries = formatSleepData(sleepData);
    console.log(apexChartSeries);
    // ApexCharts options
    const options = {
      series: apexChartSeries,
      chart: {
        height: 350,
        type: "rangeBar",
      },
      plotOptions: {
        bar: {
          horizontal: true,
        },
      },
      dataLabels: {
        enabled: true,
        formatter: function (val) {
          //   var a = new Date(val[0]);
          //   var b = new Date(val[1]);

          //   // Calculate the difference in hours and minutes
          //   var diffHours = b.getHours() - a.getHours();
          //   var diffMinutes = b.getMinutes() - a.getMinutes();

          // Display the sleep duration
          return `${durationHours} hours ${durationMinutes} minutes`;
        },
      },
      fill: {
        type: "gradient",
        gradient: {
          shade: "light",
          type: "vertical",
          shadeIntensity: 0.25,
          gradientToColors: undefined,
          inverseColors: true,
          opacityFrom: 1,
          opacityTo: 1,
          stops: [50, 0, 100, 100],
        },
      },
      xaxis: {
        type: "datetime",
      },
      legend: {
        position: "top",
      },
    };

    // Initialize and render the ApexCharts
    const chart = new ApexCharts(
      document.querySelector("#quality-sleep"),
      options,
    );
    chart.render();
  } else {
    console.log("Loading...");
  }
}

fetchDataAndRender();
