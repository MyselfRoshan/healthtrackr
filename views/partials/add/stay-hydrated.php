<!-- <section class="stay-hydrated add-wrapper">
  <header>
    <h1 class="ff-leauge-gothic fs-700 text-accent text-center">
      Stay Hydrated
    </h1>
  </header>
  <form class="glass-water__form">
    <div class="glass-inputs-container py-4">
      <label for="date-to-record">Choose Date:</label>
      <input type="date" id="date-to-record" max="<?= date('Y-m-d') ?>" min="<?= date("Y-m-d", strtotime("-1 year")) ?>" value="<?= date('Y-m-d') ?>" name="dateToRecord" />
      <?= date('Y-m-d\TH:i'); ?>
      <?= date("Y-m-d", strtotime("-1 year")) ?>

      <label for="duration">Set Target (1 glass = 250ml):</label>
      <input type="number" id="set-glass-target" name="setGlassTarget" min="1" max="50" value="8" aria-labelledby="label__set-glass-target" />
    </div>
    <div class="glass-water mx-auto my-8"></div>
    <div class="glass__controller d-flex">
      <button type="button" class="glass-add">
        <ion-icon name="add"></ion-icon>
      </button>
      <div class="glass-info d-flex">
        <p>
          <span class="glass-to-intake fs-1000 fw-500">0</span>
          /
          <span class="glass-target">8 Glasses</span>
        </p>
        <p class="water-to-intake d-flex fw-500">(0 ml)</p>
      </div>
      <button type="button" class="glass-remove">
        <ion-icon name="remove"></ion-icon>
      </button>
    </div>
    <button type="submit" class="btn btn-m mt-4 mx-auto">Save</button>
  </form>
</section> -->

<section class="stay-hydrated add-wrapper">
            <header>
              <h1 class="ff-leauge-gothic fs-700 text-accent text-center">
                Stay Hydrated
              </h1>
            </header>
            <form class="glass-water__form">
              <div class="glass-inputs-container py-4">
                <label for="select-date">Choose Date:</label>
                <input type="text" id="select-date" name="selectDate" />

                <label for="duration">Set Target (1 glass = 250ml):</label>
                <input
                  type="number"
                  id="set-glass-target"
                  name="setGlassTarget"
                  min="1"
                  max="50"
                  value="8"
                  aria-labelledby="label__set-glass-target"
                />
              </div>
              <div class="glass-water mx-auto my-8"></div>
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
              <button type="submit" class="btn btn-m mt-4 mx-auto">Save</button>
            </form>
          </section>