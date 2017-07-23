<div class="ui fixed menu" style="color:#092147 !important;">
  <div class="ui container">
    <a href="<?php echo base_url(); ?>landingpage" class="header item">
      <img class="logo" src="<?php echo base_url('assets/images/logo.png'); ?>">&nbsp;&nbsp;Parkt
    </a>
    <div class="right menu">
        </div>



      <a class="item" id="add_menu">
        <i class="big add circle icon"></i>
        Add Parking Spot
        <div id="add_barrier_modal" class="ui long modal">
          <div class="header">
            <i class="add circle icon"></i>
            Add Parking Spot
          </div>
          <div class="content">
            <form id="add_form" class="ui form">
              <div class="two required fields">
                <div class="field">
                  <label>Parking Spot ID</label>
                  <input type="text" id="barrier_id" maxlength="50" placeholder="S&R Parking">
                </div>
                <div class="field">
                  <label>Parking Spot Key</label>
                  <input type="text" id="barrier_key" maxlength="50" placeholder="a0s5d86a2s">
                </div>
              </div>
              <h4 class="ui dividing header">Coordinates</h4>
              <div class="two required fields">
                <div class="field">
                  <label>Latitude</label>
                  <input type="text" id="latitude" maxlength="30" placeholder="00.0000">
                </div>
                <div class="field">
                  <label>Longitude</label>
                  <input type="text" id="longitude" maxlength="30" placeholder="00.0000">
                </div>
            </div>
            </form>
            <div class="ui equal width center aligned grid">
              <div class="row">
                <div class="column">
                  <button class="fluid ui orange button top attached" id="curr">Same as current location</button>
                  <div class="ui attached message">
                  Click the <i class=" crosshairs icon"></i> icon located at the lower right hand side of the screen to get the current location.
                  </div>
                </div>
                <div class="column">
                  <button class="fluid ui orange button top attached" id="added">Same as marker added on map</button>
                  <div class="ui attached message">
                  Click the place on the map where you want to add a new parking spot. Note that you can only add one at a time.
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="actions">
            <div class="ui blue basic reset button">Reset
            </div>
            <div class="ui red cancel button">Cancel
            </div>
            <button class="ui green submit button" type="submit" id="save">Save</button>
          </div>
        </div>
      </a>
    </div>
  </div>
</div>
