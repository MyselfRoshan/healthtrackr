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
        <label for="targetQuantity">Target Quantity (<span id="targetUnit"></span>):</label>
        <input type="number" id="targetQuantity" name="target_quantity" value="1" min="1" max="20" />
        <!-- <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" value="1" /> -->
        <!-- Change quanity as same as stay hydrated -->
        <div class="glass__controller d-flex">
            <button type="button" class="quantity-remove">
                <ion-icon name="remove"></ion-icon>
            </button>
            <div class="glass-info d-flex">
                <p>
                    <span>
                        Actual:
                        <span id="quantity" class="quantity">Actual: 0</span>
                    </span>
                    /
                    <span id="targetQuantityValue">1</span>
                </p>
                <p id="unit"></p>
            </div>

            <button type="button" class="quantity-add">
                <ion-icon name="add"></ion-icon>
            </button>
        </div>
        <button type="submit" class="btn btn-m mx-auto mt-4 fw-500">Save Meal</button>
    </form>
</section>

<div id="food-composition" class="add-wrapper">
    <h2 class="ff-leauge-gothic fs-700 text-accent pb-8">Food Composition</h2>
    <dl id="foodInfoList"></dl>
</div>

<div class="notification"></div>