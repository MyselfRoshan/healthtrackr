export default class Food {
  constructor(name, composition, unit) {
    this.name = name;
    this.composition = composition;
    this.unit = unit;
  }

  displayInfo() {
    document.getElementById("foodInfoList").innerHTML = "";
    for (const nutrient in this.composition) {
      const nutrientDiv = document.createElement("div");
      nutrientDiv.className = "food-info d-flex my-2 text-primary";

      const dtElement = document.createElement("dt");
      dtElement.className = "text-accent fw-700";
      dtElement.textContent = nutrient;

      const ddElement = document.createElement("dd");
      ddElement.id = `${nutrient}`;
      ddElement.textContent = this.composition[nutrient];
      document.getElementById("unit").textContent = this.unit;

      nutrientDiv.appendChild(dtElement);
      nutrientDiv.appendChild(ddElement);
      document.getElementById("foodInfoList").appendChild(nutrientDiv);
    }
  }

  // calculateComposition(numberOfUnits) {
  //   const calculatedComposition = {};

  //   for (const nutrient in this.composition) {
  //     // Assuming all compositions are in grams
  //     console.log(nutrient, this.composition[nutrient].);
  //     calculatedComposition[nutrient] = (
  //       parseFloat(this.composition[nutrient]) * numberOfUnits
  //     ).toFixed(2);
  //   }

  //   return calculatedComposition;
  // }

  /* TO DO show multiplied number in food composition */
  calculateComposition(numberOfUnits) {
    const calculatedComposition = {};

    for (const nutrient in this.composition) {
      const [numericalPart, unitPart] =
        this.composition[nutrient].match(/([\d.]+)([^\d]*)/);
      const calculatedNumericalPart = (
        parseFloat(numericalPart) * numberOfUnits
      ).toFixed(2);
      calculatedComposition[nutrient] = `${calculatedNumericalPart}${unitPart}`;
    }

    return calculatedComposition;
  }
}
