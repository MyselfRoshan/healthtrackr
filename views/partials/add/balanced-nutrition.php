<section class="balanced-nutrition add-wrapper">
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
        <label for="quantity">Target Quantity:</label>
        <input type="number" id="targetQuantity" name="target_quantity" value="1" />
        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" value="1" />
        <!-- Change quanity as same as stay hydrated -->
        <div class="glass__controller d-flex">
            <button type="button" class="glass-remove">
                <ion-icon name="remove"></ion-icon>
            </button>
            <div class="glass-info d-flex">
                <p>
                    <span class="glass-to-intake fs-1000 fw-500">0</span>
                    /
                    <span class="glass-target">8 Glasses</span>
                </p>
                <p class="water-to-intake d-flex fw-500">(0 ml)</p>
            </div>

            <button type="button" class="glass-add">
                <ion-icon name="add"></ion-icon>
            </button>
        </div>
        <span id="unit"></span>
        <button type="submit" class="btn btn-m">Save Exercise</button>
    </form>
</section>

<div id="food-composition" class="add-wrapper">
    <h2 class="ff-leauge-gothic fs-700 text-accent pb-8">Food Composition</h2>
    <dl id="foodInfoList"></dl>
</div>

<div class="notification"></div>