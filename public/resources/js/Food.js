// export default class Food {
//   constructor(name, composition, unit, quantity = 1) {
//     this.name = name;
//     this.unit = unit;
//     this.composition = composition;
//     this.composition =
//       quantity !== 1 ? this.calculateComposition(quantity) : composition;
//   }

//   displayInfo() {
//     document.getElementById("foodInfoList").innerHTML = "";
//     for (const nutrient in this.composition) {
//       const nutrientDiv = document.createElement("div");
//       nutrientDiv.className = "food-info d-flex my-2 text-primary";

//       const dtElement = document.createElement("dt");
//       dtElement.className = "text-accent fw-700";
//       dtElement.textContent = nutrient;

//       const ddElement = document.createElement("dd");
//       ddElement.id = `${nutrient}`;
//       ddElement.textContent = this.composition[nutrient];
//       document.getElementById("unit").textContent = this.unit;

//       nutrientDiv.appendChild(dtElement);
//       nutrientDiv.appendChild(ddElement);
//       document.getElementById("foodInfoList").appendChild(nutrientDiv);
//     }
//   }

//   calculateComposition(numberOfUnits) {
//     const calculatedComposition = {};
//     function extractNumberAndUnit(inputString) {
//       const match = inputString.match(/(\d+(\.\d+)?)\s*([a-zA-Z]+)/);
//       return match ? [match[1], match[3]] : null;
//     }
//     for (const nutrient in this.composition) {
//       const [numericalPart, unitPart] = extractNumberAndUnit(
//         this.composition[nutrient],
//       );
//       const calculatedNumericalPart =
//         parseFloat(numericalPart) * parseInt(numberOfUnits);
//       const formattedNumericalPart = Number.isInteger(calculatedNumericalPart)
//         ? calculatedNumericalPart.toString()
//         : calculatedNumericalPart.toFixed(2);

//       calculatedComposition[nutrient] =
//         formattedNumericalPart == 0
//           ? "-"
//           : `${formattedNumericalPart}${unitPart}`;
//     }
//     return calculatedComposition;
//   }
// }

export default class Food {
  constructor(name, composition, unit, quantity = 1) {
    this.name = name;
    this.unit = unit;
    this.composition = composition;
    this.composition =
      quantity !== 1 ? this.calculateComposition(quantity) : composition;
  }

  displayInfo() {
    const foodInfoList = document.getElementById("foodInfoList");
    foodInfoList.innerHTML = "";

    for (const nutrient in this.composition) {
      const nutrientDiv = document.createElement("div");
      nutrientDiv.className = "food-info d-flex my-2 text-primary";

      const dtElement = document.createElement("dt");
      dtElement.className = "text-accent fw-700";
      dtElement.textContent = nutrient;

      const ddElement = document.createElement("dd");
      ddElement.id = `${nutrient}`;
      ddElement.textContent = this.composition[nutrient];

      nutrientDiv.appendChild(dtElement);
      nutrientDiv.appendChild(ddElement);
      foodInfoList.appendChild(nutrientDiv);
    }

    document.getElementById("unit").textContent = this.unit;
  }

  calculateComposition(numberOfUnits) {
    function extractNumberAndUnit(inputString) {
      const match = inputString.match(/(\d+(\.\d+)?)\s*([a-zA-Z]+)/);
      return match ? [parseFloat(match[1]), match[3]] : null;
    }

    const calculatedComposition = {};

    for (const nutrient in this.composition) {
      const [numericalPart, unitPart] = extractNumberAndUnit(
        this.composition[nutrient],
      );
      const calculatedNumericalPart = numericalPart * parseInt(numberOfUnits);
      const formattedNumericalPart =
        calculatedNumericalPart % 1 === 0
          ? calculatedNumericalPart.toString()
          : calculatedNumericalPart.toFixed(2);

      calculatedComposition[nutrient] =
        formattedNumericalPart === "0"
          ? "-"
          : `${formattedNumericalPart}${unitPart}`;
    }

    return calculatedComposition;
  }
}
