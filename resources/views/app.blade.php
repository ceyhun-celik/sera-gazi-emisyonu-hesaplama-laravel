<!DOCTYPE html>
<html lang="zxx">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="description" content="">
      <meta name="author" content="">
      <link rel="shortcut icon" href="images/favicon.png">
      <title>Dijital Mentor</title>
      <link href="css/bootstrap.css" rel="stylesheet">
      <link href="css/fontawesome.css" rel="stylesheet">
      <link href="css/smooth-scrollbar.css" rel="stylesheet">
      <link href="css/style.css" rel="stylesheet">
      <link href="css/responsive.css" rel="stylesheet">
   </head>
   <body>
    <div class="dash-app">
        <div class="dash-content">
           <div class="maintitlesec bluebg">
              <h1><img src="images/pot-icon.svg" alt="" /> STATIONARY COMBUSTION</h1>
           </div>
           <div class="middlesection">
              <div class="container">
                 <div class="formboxsec">
                    <form id="stationaryCombustionForm" method="post" action="">
                       <div class="row">
                          <div class="col-md-6">
                             <div class="formtitle">
                                <h3>GİRDİ ALANI</h3>
                                <p>Lütfen salınım değerlerini hesaplamak için aşağıdaki alanları doldurun:</p>
                             </div>
                             <div class="alaniform formmaxwid">
                                <div class="mb-3">
                                   <label class="form-label">Facilty ID</label>
                                   <div class="selct-dropdown fullwidthselectbox selroundbox">
                                      <select id="facility_id">
                                       @foreach ($facilities as $facility)
                                          @if($loop->first)
                                             <option value="">Facilty ID</option>
                                          @endif

                                          <option value="{{ $facility->id }}">{{ $facility->facility_name }}</option>
                                       @endforeach
                                      </select>
                                   </div>
                                </div>
                                <div class="mb-3">
                                   <label class="form-label">Year</label>
                                   <div class="selct-dropdown fullwidthselectbox selroundbox">
                                      <select id="year">
                                       @foreach ($years as $year)
                                          @if($loop->first)
                                             <option value="">Year</option>
                                          @endif

                                          <option value="{{ $year->id }}">{{ $year->year_value }}</option>
                                       @endforeach
                                      </select>
                                   </div>
                                </div>
                                <div class="mb-3">
                                   <label class="form-label">Fuel</label>
                                   <div class="selct-dropdown fullwidthselectbox selroundbox">
                                      <select id="fuel">
                                          @foreach ($fuels as $type)
                                             @if($loop->first)
                                                <option value="">Fuel</option>
                                             @endif

                                             <option fuel_value="{{ $type->fuel_value }}" value="{{ $type->id }}">{{ $type->fuel_name }}</option>
                                          @endforeach
                                      </select>
                                   </div>
                                </div>
                                <div class="mb-3">
                                   <label class="form-label">Amount of fuel</label>
                                   <div>
                                      <div class="selroundbox amountoffuelbox">
                                         <div class="inputselectflex">
                                            <div class="griinput">
                                               <input class="borinput" id="amount_of_fuel" type="number" name="" placeholder="Giriniz">
                                            </div>
                                            <div class="selct-dropdown fullwidthselectbox">
                                               <label class="form-label">Units</label>
                                               <select id="units">
                                                   @foreach ($units as $unit)
                                                      @if($loop->first)
                                                         <option value="">Seçiniz</option>
                                                      @endif
         
                                                      <option unit_value="{{ $unit->unit_value }}" value="{{ $unit->id }}">{{ $unit->unit_name }}</option>
                                                   @endforeach
                                               </select>
                                            </div>
                                         </div>
                                      </div>
                                   </div>
                                </div>
                             </div>
                          </div>
                          <div class="col-md-6">
                             <div class="rightformPL">
                                <div class="formtitle">
                                   <h3>SONUÇ ALANI</h3>
                                   <p>Girdi Alanı'nda girdiğiniz değerlere göre salınan gaz miktarları aşağıdaki gibidir:</p>
                                </div>
                                <div class="sonucalaniformlist">
                                   <ul>
                                      <li>
                                         <div>
                                            <span>CO<sub>2</sub></span>
                                            <input type="text" name="" id="co2" placeholder="">
                                         </div>
                                      </li>
                                      <li>
                                         <div>
                                            <span>CH<sub>4</sub></span>
                                            <input type="text" name="" id="ch4" placeholder="">
                                         </div>
                                      </li>
                                      <li>
                                         <div>
                                            <span>N<sub>2</sub>O</span>
                                            <input type="text" name="" id="n2o" placeholder="">
                                         </div>
                                      </li>
                                      <li>
                                         <div>
                                            <span>CO<sub>2</sub><sup>e</sup></span>
                                            <input type="text" name="" id="co2e" placeholder="">
                                         </div>
                                      </li>
                                   </ul>
                                </div>
                                <div class="sublinkbnt">
                                   <input type="button" id="resetDataConfirmBtn" name="reset" value="Sıfırla">
                                   <input type="button" id="storeFormData" name="Kaydet" value="Kaydet">
                                </div>
                             </div>
                          </div>
                       </div>
                    </form>
                 </div>
                 <div class="formtablesec">
                    <h4>Hesaplamalar</h4>
                    <div class="table-responsive fortab samwd">
                       <table id="storeDataTable" class="table table-bordered cstmTable basicTable cusrmrTable tablehovetr">
                          <thead>
                             <tr>
                                <th class="smw fnt14">Facilty ID</th>
                                <th class="fnt14">Year</th>
                                <th class="fnt14">Fuel</th>
                                <th class="lefttext fnt14">Amount of <br>Fuel</th>
                                <th class="fnt14">Units</th>
                                <th class="fnt15"><span>CO<sub>2</sub></span></th>
                                <th class="fnt15"><span>CH<sub>4</sub></span></th>
                                <th class="fnt15"><span>N<sub>2</sub>O</span></th>
                                <th class="fnt15"><span>CO<sub>2</sub><sup>e</sup></span></th>
                                <th class="smw">&nbsp;</th>
                             </tr>
                          </thead>
                          <tbody class="boxr"></tbody>
                       </table>
                    </div>
                 </div>
              </div>
           </div>
        </div>
     </div>


      <script src="js/jquery-3.6.0.js"></script>
      <script src="js/popper.min.js"></script>
      <script src="js/spur.js"></script>
      <script src="js/bootstrap.js"></script>
      <script src="js/slectdropdown.js"></script>
      <script src="js/jquery.basictable.min.js"></script>
      <script>
          $(document).ready(function() {
            $('.basicTable').basictable({
              breakpoint: 767
            });
          });
      </script>
      <script src="js/form-data.js"></script>

      <script src="js/jquery.nicescroll.min.js"></script>
      <script>
        $(document).ready(function() {
          $(".boxscroll").niceScroll({cursorborder:"",cursorcolor:"#0D1840",cursoropacitymax:0.7,boxzoom:true,touchbehavior:true}); // 
        });
      </script>
      <script src="js/app.js"></script>
   </body>
</html>

