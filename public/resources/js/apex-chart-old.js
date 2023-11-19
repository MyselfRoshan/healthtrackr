// async function setData(endpoint, storageKey) {
//   try {
//     const response = await ajax(`${window.location.href}${endpoint}`);
//     const data = await response.json();
//     localStorage.setItem(storageKey, JSON.stringify(data));
//   } catch (error) {
//     console.error(`Error setting ${storageKey} data:`, error);
//   }
// }

// // Usage
// async function fetchDataAndRender() {
//   // Use Promise.all to wait for all data fetching operations to complete
//   await Promise.all([
//     setData("/add/daily-exercise/data", "Exercise"),
//     setData("/add/quality-sleep/data", "Sleep"),
//     setData("/add/stay-hydrated/data", "Water"),
//   ]);

//   // Now that all data is fetched, render the chart
//   renderChartOrLoading();
// }

// function renderChartOrLoading() {
//   const Water = JSON.parse(localStorage.getItem("Water"));

//   if (Water) {
//     const dates = Object.keys(Water).sort();
//     const targets = dates.map(date => Water[date].target);
//     const intaked = dates.map(date => Water[date].intaked);
//     const maxToDisplay = Math.max(...targets.concat(intaked));
//     console.log(dates, targets, intaked);
//     let optionsLine = {
//       chart: {
//         height: 328,
//         type: "line",
//         zoom: {
//           enabled: true,
//         },
//         dropShadow: {
//           enabled: true,
//           top: 3,
//           left: 2,
//           blur: 4,
//           opacity: 1,
//         },
//       },
//       stroke: {
//         curve: "smooth",
//         width: 2,
//       },
//       //colors: ["#3F51B5", '#2196F3'],
//       series: [
//         {
//           name: "Intaked",
//           data: intaked,
//         },
//         {
//           name: "Target",
//           data: targets,
//         },
//       ],
//       title: {
//         text: "Water",
//         align: "Center",
//         offsetY: 25,
//         offsetX: 20,
//       },
//       markers: {
//         size: 6,
//         strokeWidth: 0,
//         hover: {
//           size: 9,
//         },
//       },
//       grid: {
//         show: true,
//         padding: {
//           bottom: 0,
//         },
//       },
//       labels: dates,
//       xaxis: {
//         tooltip: {
//           enabled: false,
//         },
//       },
//       yaxis: {
//         title: {
//           text: "Glasses (1 Glass = 250 ml)",
//         },
//         min: 0,
//         max: maxToDisplay,
//       },
//       legend: {
//         position: "top",
//         horizontalAlign: "right",
//         offsetY: -20,
//       },
//     };

//     var chartLine = new ApexCharts(
//       document.querySelector("#stay-hydrated"),
//       optionsLine,
//     );
//     chartLine.render();

//     console.log("Rendering chart with data");
//   } else {
//     // Display a loading indicator
//     console.log("Loading...");
//   }
// }
// fetchDataAndRender();
