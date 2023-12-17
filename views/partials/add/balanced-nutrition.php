<section class="daily-exercise add-wrapper">
    <header class="d-flex pb-8">
        <h1 class="ff-leauge-gothic fs-700 text-accent">
            Balanced Nutrition
        </h1>
        <div class="toggle-container d-flex">
            <span class="text-tertiary fw-500">
                Send email reminder
            </span>
            <input type="checkbox" id="send-reminder__toggle" name="food_reminder" />
            <label for="send-reminder__toggle">Toggle</label>
        </div>
    </header>

    <form method="post" id="activity-form" enctype="multipart/form-data">
        <label for="selectDate">Select Date:</label>
        <input type="text" id="selectDate" name="selectDate" />

        <label for="mealType">Select Meal Type:</label>
        <select id="mealType" name="meal_type">
            <option value="breakfast">Breakfast</option>
            <option value="launch">Launch</option>
            <option value="snack">Snack</option>
            <option value="dinner">Dinner</option>
        </select>

        <label for="food">Select Food:</label>
        <select id="food" name="food">
            <?php
            $foodFilePath = BASE_PATH . 'public/resources/js/food.json';

            // Check if the file exists before proceeding
            if (file_exists($foodFilePath)) {
                $foodsJson = file_get_contents($foodFilePath);
                $foods = json_decode($foodsJson, true);

                foreach ($foods as $foodValue => $value) {
                    $foodName = ucwords(str_replace('_', ' ', $foodValue));
                    echo "<option value='{$foodValue}'>{$foodName}</option>";
                }
            } else {
                echo "Food file not found.";
            }
            ?>

        </select>
        <!-- Use unit from json instead of time -->
        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" value="1" />
        <span id="unit"></span>
        <button type="submit" class="btn btn-m">Save Exercise</button>
    </form>
</section>

<div id="food-composition" class="add-wrapper">
    <h2 class="ff-leauge-gothic fs-700 text-accent pb-8">Food Composition</h2>
    <dl id="foodInfoList"></dl>
</div>

<div class="notification"></div>