<?php

class BssCoriolisCalculator {

    protected $_corioliscalc_options = NULL;

    public function __construct(){

        $this->_corioliscalc_options = get_option( 'corioliscalc' );
        add_shortcode("coriolis-calculator",array("BssCoriolisCalculator",'showCalculator'));

    }

    public function initScripts( ){

    }

    public static function showCalculator(){

        ob_start();
        ?>
        <script type="text/javascript">
           
            'use strict';

            var isECValValid  = function (val) {

                if(isNumeric(val)){
                    if(val>0){
                        return true;
                    }
                }
                return false;
            };

            var hemisphereNorth = true;

            var changeHemisphere = function () {
                if(hemisphereNorth){
                    document.getElementById("coriolis-hemisphere-label").textContent = "Southern";
                    document.getElementById("coriolis-hemisphere-label-dir").textContent = "Left";
                    document.getElementById("coriolis-hemisphere-north").style.display = 'none';
                    document.getElementById("coriolis-hemisphere-south").style.display = 'block';
                }else{
                    document.getElementById("coriolis-hemisphere-label").textContent = "Northern";
                    document.getElementById("coriolis-hemisphere-label-dir").textContent = "Right";
                    document.getElementById("coriolis-hemisphere-north").style.display = 'block';
                    document.getElementById("coriolis-hemisphere-south").style.display = 'none';
                }
                hemisphereNorth = !hemisphereNorth;
            }

            var calculateCoriolis = function (lat,velocity,mass){
                let earthangularvelocity = 0.0000727;
                return  2*mass/1000*velocity*earthangularvelocity*Math.sin(lat*Math.PI / 180);
            }

            var calculate = function(btn) {

                // console.log(document.getElementById("mec-weight").value);
                
                var mass = document.getElementById("mec-weight").value;
                var velocity = document.getElementById("mec-velocity").value;
                var latitude = document.getElementById("mec-latitude").value;

                if(isECValValid(mass) && isECValValid(velocity) && isECValValid(latitude)){

                    var massSI = mass/15.432;
                    var velocitySI = velocity/3.281;

                    var coriolisForce = calculateCoriolis(latitude,velocitySI,massSI);

                    document.getElementById("mec-result-force").textContent = coriolisForce;
                    document.getElementById("mec-result-acceleration").textContent = (coriolisForce/massSI*1000).toFixed(7);
                } else {
                    if(btn){
                        document.getElementById("mec-weight").classList.add('error');
                        document.getElementById("mec-velocity").classList.add('error');
                        setTimeout(
                            function () {
                                document.getElementById("mec-weight").classList.remove('error');
                                document.getElementById("mec-velocity").classList.remove('error');
                            },
                            500
                        );
                    }
                }

            };

            ready(function() {
                
                document.querySelector(".b-coriolis-calculator_action").addEventListener("click", function(evt) {
                    calculate(true);
                    evt.preventDefault();
                });

                document.getElementById("coriolis-hemisphere-change").addEventListener("click", function(evt) {
                    changeHemisphere();
                    evt.preventDefault();
                });

                ["change", "paste", "keyup"].forEach( function(evt) {
                    document.getElementById("mec-weight").addEventListener(evt, calculate(false), false);
                });

                ["change", "paste", "keyup"].forEach( function(evt) {
                    document.getElementById("mec-velocity").addEventListener(evt, calculate(false), false);
                });

                ["change", "paste", "keyup"].forEach( function(evt) {  
                    document.getElementById("mec-latitude").addEventListener(evt, calculate(false), false);
                });
            });

            // helper function ready, just in case we need to IE9 support
            function ready(fn) {
                if (document.readyState !== 'loading'){
                    fn();
                } else {
                    document.addEventListener('DOMContentLoaded', fn);
                }
            }

            // heper function - like jQuery isNumeric()
            function isNumeric(val) {
                return Number(parseFloat(val)) === val;
            }

        </script>

        <div class="b-coriolis-calculator" style=" ">
            <h4 class="b-coriolis-calculator__title">Coriolis  Calculator</h4>
            <div class="b-coriolis-calculator_input ">
                <span class="b-coriolis-calculator-icon b-coriolis-calculator-icon--weight">
                </span>
                <input id="mec-weight" placeholder="Enter Weight (grain)" type="text" name="coriolis_energy_weight" class="b-coriolis-calculator-input-field">
            </div>
            <div class="b-coriolis-calculator_input ">
                <span class="b-coriolis-calculator-icon b-coriolis-calculator-icon--velocity">
                </span>
                <input id="mec-velocity" placeholder="Enter Velocity (feet per second)" type="text" name="coriolis_energy_velocity" class="b-coriolis-calculator-input-field">
            </div>
            <div class="b-coriolis-calculator_input ">
                <span class="b-coriolis-calculator-icon b-coriolis-calculator-icon--latitude">
                </span>
                <input id="mec-latitude" placeholder="Enter Latitude (degrees)" type="text" name="coriolis_energy_latitude" class="b-coriolis-calculator-input-field">
            </div>
            <div class="b-coriolis-calculator_input" id="coriolis-hemisphere-change">
                <span class="b-coriolis-calculator-icon">
                    <svg id="coriolis-hemisphere-north" height="32px" version="1.1" viewBox="0 0 32 32" width="32px" xmlns="http://www.w3.org/2000/svg"  xmlns:xlink="http://www.w3.org/1999/xlink"><title/><defs/><g fill="none" fill-rule="evenodd" id="Icons new Arranged Names Color" stroke="none" stroke-width="1"><g id="92 Compass Nord"><path d="M16,30 C8.26801312,30 2,23.7319869 2,16 C2,8.26801312 8.26801312,2 16,2 C23.7319869,2 30,8.26801312 30,16 C30,23.7319869 23.7319869,30 16,30 Z M16,28 C22.6274173,28 28,22.6274173 28,16 C28,9.37258267 22.6274173,4 16,4 C9.37258267,4 4,9.37258267 4,16 C4,22.6274173 9.37258267,28 16,28 Z M16,28" fill="#404040" id="Oval 278"/><path d="M16,5 C16,5 20,13.7900009 20,16 C19.9999999,18.2099991 18.2091391,20 16,20 C13.7908609,20 12.0000001,18.2099991 12,16 C12,13.7900009 16,5 16,5 Z M16,18 C17.1045696,18 18,17.1045696 18,16 C18,14.8954304 17.1045696,14 16,14 C14.8954304,14 14,14.8954304 14,16 C14,17.1045696 14.8954304,18 16,18 Z M16,18" fill="#499dbf" id=""/></g></g></svg>
                    <svg id="coriolis-hemisphere-south" height="32px" version="1.1" viewBox="0 0 32 32" width="32px" xmlns="http://www.w3.org/2000/svg"  xmlns:xlink="http://www.w3.org/1999/xlink"><title/><defs/><g fill="none" fill-rule="evenodd" id="Icons new Arranged Names Color" stroke="none" stroke-width="1"><g id="94 Compass South"><path d="M16,30 C8.26801312,30 2,23.7319869 2,16 C2,8.26801312 8.26801312,2 16,2 C23.7319869,2 30,8.26801312 30,16 C30,23.7319869 23.7319869,30 16,30 Z M16,28 C22.6274173,28 28,22.6274173 28,16 C28,9.37258267 22.6274173,4 16,4 C9.37258267,4 4,9.37258267 4,16 C4,22.6274173 9.37258267,28 16,28 Z M16,28" fill="#404040" id="Oval 278 copy"/><path d="M16,27 C16,27 12,18.2099991 12,16 C12.0000001,13.7900009 13.7908609,12 16,12 C18.2091391,12 19.9999999,13.7900009 20,16 C20,18.2099991 16,27 16,27 Z M16,18 C17.1045696,18 18,17.1045696 18,16 C18,14.8954304 17.1045696,14 16,14 C14.8954304,14 14,14.8954304 14,16 C14,17.1045696 14.8954304,18 16,18 Z M16,18" fill="#FF0000" id=""/></g></g></svg>
                </span>
                <span class="b-coriolis-calculator_input-hemisphere">Hemisphere: <span id="coriolis-hemisphere-label">Northern</span> (click to change)</span>
                <span class="b-coriolis-calculator_input-hemisphere">Deflects to: <span id="coriolis-hemisphere-label-dir">Right</span></span>
            </div>
            <div class="b-coriolis-calculator_output ">
                <div class="b-coriolis-calculator-description">Coriolis force (N) <span id="mec-result-force"
                                                                                        class="b-coriolis-calculator-output-field">
                    0
                </span></div>
                <div class="b-coriolis-calculator-description">Coriolis acceleration (m/s<sup>2</sup>) <span
                        id="mec-result-acceleration" class="b-coriolis-calculator-output-field">
                    0
                </span></div>

            </div>
            <a href="#" class="b-coriolis-calculator_action">
                <span class="b-coriolis-calculator-description">
                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="calculator" class="svg-inline--fa fa-calculator fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M400 0H48C22.4 0 0 22.4 0 48v416c0 25.6 22.4 48 48 48h352c25.6 0 48-22.4 48-48V48c0-25.6-22.4-48-48-48zM128 435.2c0 6.4-6.4 12.8-12.8 12.8H76.8c-6.4 0-12.8-6.4-12.8-12.8v-38.4c0-6.4 6.4-12.8 12.8-12.8h38.4c6.4 0 12.8 6.4 12.8 12.8v38.4zm0-128c0 6.4-6.4 12.8-12.8 12.8H76.8c-6.4 0-12.8-6.4-12.8-12.8v-38.4c0-6.4 6.4-12.8 12.8-12.8h38.4c6.4 0 12.8 6.4 12.8 12.8v38.4zm128 128c0 6.4-6.4 12.8-12.8 12.8h-38.4c-6.4 0-12.8-6.4-12.8-12.8v-38.4c0-6.4 6.4-12.8 12.8-12.8h38.4c6.4 0 12.8 6.4 12.8 12.8v38.4zm0-128c0 6.4-6.4 12.8-12.8 12.8h-38.4c-6.4 0-12.8-6.4-12.8-12.8v-38.4c0-6.4 6.4-12.8 12.8-12.8h38.4c6.4 0 12.8 6.4 12.8 12.8v38.4zm128 128c0 6.4-6.4 12.8-12.8 12.8h-38.4c-6.4 0-12.8-6.4-12.8-12.8V268.8c0-6.4 6.4-12.8 12.8-12.8h38.4c6.4 0 12.8 6.4 12.8 12.8v166.4zm0-256c0 6.4-6.4 12.8-12.8 12.8H76.8c-6.4 0-12.8-6.4-12.8-12.8V76.8C64 70.4 70.4 64 76.8 64h294.4c6.4 0 12.8 6.4 12.8 12.8v102.4z"></path></svg>
                    <span>Calculate</span>
                </span>
            </a>
        </div>


        <?php

        return ob_get_clean();
    }

}

add_action('init',function (){
    $corioliscalc = new BssCoriolisCalculator();
});


