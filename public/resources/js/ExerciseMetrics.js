class ExerciseMetrics {
  constructor() {
    this.caloriesBurned = 0;
    this.fatBurn = 0;
    this.vo2Max = 0;
    this.totalHeartRate = 0;
    this.totalDuration = 0;
    this.intensity = 0;
  }

  // Method to calculate calories burned
  calculateCaloriesBurned(weight, exerciseDuration, caloriesPerMinute) {
    // Assuming a basic formula, you may replace it with a more accurate one
    this.caloriesBurned = caloriesPerMinute * exerciseDuration;
    return this.caloriesBurned;
  }
  calculateCaloriesBurned(
    weight,
    height,
    exerciseDuration,
    calorieBurnPerMinute,
    met,
  ) {
    // Convert height from cm to meters
    var heightInMeters = height / 100;

    // Calculate MET-adjusted calorie burn
    var calorieBurn = weight * 0.035 * met * exerciseDuration;

    // Calculate total calorie burn
    var totalCalorieBurn =
      calorieBurn + calorieBurnPerMinute * exerciseDuration;

    return totalCalorieBurn.toFixed(2); // Round to two decimal places
  }

  // Method to calculate fat burn
  calculateFatBurn() {
    // Assuming a basic formula, you may replace it with a more accurate one
    this.fatBurn = 0.5 * this.caloriesBurned; // Adjust as needed
    return this.fatBurn;
  }

  // Method to calculate VO2 max
  calculateVO2Max() {
    // Assuming a basic formula, you may replace it with a more accurate one
    this.vo2Max = 15 * (this.totalHeartRate / this.totalDuration); // Adjust as needed
    return this.vo2Max;
  }

  // Method to calculate average heart rate
  calculateAverageHeartRate(heartRates) {
    const totalHeartRate = heartRates.reduce((sum, rate) => sum + rate, 0);
    this.totalHeartRate = totalHeartRate;
    return totalHeartRate / heartRates.length;
  }

  // Method to calculate exercise intensity
  calculateExerciseIntensity() {
    // Assuming a basic formula, you may replace it with a more accurate one
    this.intensity = this.caloriesBurned / this.totalDuration; // Adjust as needed
    return this.intensity;
  }
}
