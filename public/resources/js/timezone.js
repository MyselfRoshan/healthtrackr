// async function fetchData() {
//   // Get user's timezone offset in minutes
//   let timezoneOffset = new Date().getTimezoneOffset();
//   console.log(timezoneOffset / 60);

//   try {
//     const response = await fetch("get_timezone.php", {
//       method: "POST",
//       body: JSON.stringify({ timezoneOffset: timezoneOffset }),
//       headers: {
//         "Content-Type": "application/json",
//       },
//     });

//     if (response.ok) {
//       const data = await response.text();
//       console.log("Server response:", data);
//     } else {
//       console.error("Error:", response.statusText);
//     }
//   } catch (error) {
//     console.error("Error:", error);
//   }
// }

// // Call the async function to fetch data
// fetchData();
/**
 * Get timezone data (offset and dst)
 *
 *  Inspired by: http://goo.gl/E41sTi
 *
 * @returns {{offset: number, dst: number}}
 */
// function getTimeZoneData() {
//   // var today = new Date();
//   // var jan = new Date(today.getFullYear(), 0, 1);
//   // var jul = new Date(today.getFullYear(), 6, 1);
//   // var dst =
//   //   today.getTimezoneOffset() <
//   //   Math.max(jan.getTimezoneOffset(), jul.getTimezoneOffset());
// Timezone::get_timezone_id()
//   // return {
//   //   offset: -today.getTimezoneOffset() / 60,
//   //   dst: +dst,
//   // };
//   return Intl.DateTimeFormat().resolvedOptions().timeZone
// }
// document.cookie;
document.cookie = `timeZone=${Intl.DateTimeFormat().resolvedOptions().timeZone}; SameSite=None; Secure`;
console.log(cookie.timeZone)
