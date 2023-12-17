export default class ExerciseMetrics {
  constructor() {
    this.caloriesBurned = 0;
    this.fatBurn = 0;
    this.vo2Max = 0;
    this.totalHeartRate = 0;
    this.totalDuration = 0;
    this.intensity = 0;
  }

  // Method to calculate calories burned
  calculateCaloriesBurned(weight, height, age, exerciseDuration, metValue) {
    // Use average values for Nepal if any of the values is not set or equal to 0
    if (!age || age === 0) age = 25; // Average age
    if (!weight || weight === 0) weight = 63; // Average weight in kilograms
    if (!height || height === 0) height = 165; // Average height in centimeters

    // Adjusted Harris-Benedict equation for total daily energy expenditure (TDEE)
    const basalMetabolicRate = 10 * weight + 6.25 * height - 5 * age + 5;
    // Adjust as needed
    const exerciseCaloriesBurned = (metValue * weight * exerciseDuration) / 60; // MET value per minute

    // Total calories burned including basal metabolic rate and exercise
    this.caloriesBurned = basalMetabolicRate + exerciseCaloriesBurned;
    return this.caloriesBurned;
  }

  // Method to calculate fat burn
  calculateFatBurn() {
    // Assuming a percentage of calories burned comes from fat
    const fatPercentage = 0.4; // Adjust as needed
    this.fatBurn = fatPercentage * this.caloriesBurned;
    return this.fatBurn;
  }

  // Method to calculate VO2 max
  calculateVO2Max(weight, exerciseDuration) {
    if (!weight || weight === 0) weight = 63; // Average weight in kilograms

    // Assuming a formula based on weight, exercise duration, and calories burned
    this.vo2Max = (10 * this.caloriesBurned) / (weight * exerciseDuration); // Adjust as needed
    return this.vo2Max;
  }

  // Method to calculate exercise intensity
  calculateExerciseIntensity(exerciseDuration) {
    // Assuming a formula based on calories burned and exercise duration
    this.intensity = this.caloriesBurned / exerciseDuration; // Adjust as needed
    return this.intensity.toFixed.toFixed;
  }

  getVo2Max() {
    return isFinite(this.vo2Max) ? `${this.vo2Max.toFixed(2)}  ml/min/kg` : "-";
  }

  getIntensity() {
    return isFinite(this.intensity)
      ? `${this.intensity.toFixed(2)} cal/min`
      : "-";
  }

  getFatBurn() {
    return isFinite(this.fatBurn) ? `${this.fatBurn.toFixed(2)} cal` : "-";
  }

  getCaloriesBurned() {
    return isFinite(this.caloriesBurned)
      ? `${this.caloriesBurned.toFixed(2)} cal`
      : "-";
  }
}
