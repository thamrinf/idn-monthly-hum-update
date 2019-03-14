<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>IDN Humanitarian Update</title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">

    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">

    

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.4.0/dist/leaflet.css"
   integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA=="
   crossorigin=""/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <link href="https://api.tiles.mapbox.com/mapbox-gl-js/v0.53.0/mapbox-gl.css" rel='stylesheet' />

    <!-- Custom styles for this template -->
    <link href="style.css" rel="stylesheet">

    <?php $base_url = "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']; ?>

   <style>
    #loadinggif{
      position: fixed;
      z-index: 9000;
      top: 0;
      left: 0;
      width: 100vw;
      height: 100vh;
      background: rgba(0,0,0,.4);
      padding-top: 45vh;
      display: none;
    }
    #loadinggif img{
        width: 50px;
    }
    .hrtooltip{
        margin-top: 5px;
    }
    .blockchart{
        height: 220px;
        padding-left: 0px;
    }
    .titleblock{
        text-align: center;
        margin-bottom: 15px;
        color:#787272;
        /*text-align: center;*/
    }
    .disclaimer{
        color: #A9A9A9;
        font-size:10px;
        font-style: italic;
    }
    .subtitleblock{
        margin-bottom: 10px;
        /*text-align: center;*/
    }
    .boximg{
        /*min-width: 150px;*/
        width: max-content;
        /*display: inline-flex;*/
        padding-right: 10px
    }
    @media only screen and (max-width: 767px) {
      .boximg {
        min-width: 150px;
      }
    }

    .our-choropleth{
      cursor: initial !important;
      pointer-events: none !important;
    }
    .disastermarker{
      cursor: pointer !important;
      pointer-events: auto !important;
    }
    .headerstick{
        position: sticky;
        top: 0;
        z-index: 10000;
    }

   </style>
        
    </head>
    <body>

    <div id="loadinggif"><img src="https://fr.ethicon.com/sites/all/themes/ethicon/img/ajax-loader.gif"></div>

    <!-- HEADER -->
    <div class="container headerstick">
        <div class="d-flex flex-column flex-md-row align-items-center p-2 px-md-5 mb-3 bg-white border-bottom shadow-sm">
          <div class="media-left" style="width: fit-content; padding-right: 30px"><img src="<?PHP echo $base_url?>images/OCHA_logo3.svg" class="img-responsive" style="width: 5rem"></div>
          <h2 class="my-0 mr-md-auto font-weight-bold" style="color: #817b7b; padding-top: 10px">INDONESIA: MONTHLY <br/> HUMANITARIAN UPDATE</h2>
          <nav class="my-2 my-md-0 mr-md-6 col-md-4">
            <div class="row">
                <div class="col-md-6">
                    <select id="themonth" class="form-control">
                        <option value="January">January</option>
                        <option value="February">February</option>
                        <option value="March">March</option>
                        <option value="April">April</option>
                        <option value="May">May</option>5
                        <option value="June">June</option>
      
                        <option value="July">July</option>
                        <option value="August">August</option>
                        <option value="September">September</option>
                        <option value="October">October</option>
                        <option value="November">November</option>
                        <option value="December">December</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <select id="theyear" class="form-control">
                    </select>
                </div>
            </div>
          </nav>
        </div>
     <!--  <nav class="my-2 my-md-0 mr-md-3">
        <h4 class="button" font-weight= 'bold' id="resetall">Clear Filter</h4>
      </nav> -->
        </div>
        <!-- END HEADER -->
        <div class="container">
            <div class="col-12">
                <div class="col-md-12 apanel">
                    <div class="row">
                        <div class="col-md-12" style="text-align: left; padding-left: 0px">
                            <p class="pmap"></p>
                        </div>
                    </div>
                </div>
                <div class="subtitleblock"; style= 'padding-bottom: 20px; font-weight: bold; color: #999999' >DISASTER AFFECTED AREAS</div>
                <div id="map" style="width: 100%; height: 500px"></div>

                <div class="row">
                    <div class="col-md-12" style="font-size: 17px; font-weight: bold; padding-top: 30px; padding-bottom: 10px">
                        <div class="subtitleblock"; style='font-weight: bold; color: #999999' >CURRENT KEY FIGURES WITHIN SELECTED MONTH</div>
                    </div>
                </div>
                <div class="row">
                	<div class="col-md-3" style="font-size: 17px; color: grey; padding-top: 20px; padding-left: 15px; padding-right: 5px">
                		<div class='media'>
                            <div class="media-left boximg" style="">
                                <center><img src="<?PHP echo $base_url?>images/disaster_event.svg" class="img-responsive" style='width: 5rem'></center>
                            </div>
                            <div class="media-body">
                                <h2 class="media-heading" id="valevent" style="margin-top: 20px">-</h2>
                                <p style='font-size: 12px'>number of  disaster events</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3" style="font-size: 17px; color: grey; padding-top: 20px; padding-left: 15px; padding-right: 5px">
                		<div class='media'>
                            <div class="media-left boximg" style="">
                                <center><img src="<?PHP echo $base_url?>images/casulaties.svg" class="img-responsive" style='width: 5rem'></center>
                            </div>
                            <div class="media-body">
                                <h2 class="media-heading" id="valcasualites" style="margin-top: 20px">-</h2>
                                <p style='font-size: 12px'>number of casualties</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3" style="font-size: 17px; color: grey; padding-top: 20px; padding-left: 15px; padding-right: 5px">
                		<div class='media'>
                            <div class="media-left boximg" style="">
                                <center><img src="<?PHP echo $base_url?>images/injured.svg" class="img-responsive" style='width: 5rem'></center>
                            </div>
                            <div class="media-body">
                                <h2 class="media-heading" id="valinjured" style="margin-top: 20px">-</h2>
                                <p style='font-size: 12px'>number of injured</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3" style="font-size: 17px; color: grey; padding-top: 20px; padding-left: 5px; padding-right: 5px">
                        <div class='media'>
                            <div class="media-left boximg" style="">
                                <center><img src="<?PHP echo $base_url?>images/popaffected.svg" class="img-responsive" style='width: 5rem'></center>
                            </div>
                            <div class="media-body">
                                <h2 class="media-heading" id="valaffected" style="margin-top: 20px">-</h2>
                                <p style='font-size: 12px'>number of affected population</p>
                            </div>
                        </div>
                    </div>
                </div>
	                <div class="row">
	                    <div class="col-md-12" style="font-size: 17px; font-weight: bold; margin-left:0px; padding-top: 30px; padding-bottom: 20px">
	                        <div class="subtitleblock"; style='font-weight: bold; color: #999999' >FIGURES BASED ON TYPE OF DISASTER</div>
	                    </div>
	                </div>
                <div class="row">
                    <div class="col-md-4" style="font-size: 15px; color: grey; padding-top: 5px">
                        <div class="titleblock" style='padding-left: 15px'>Number of disaster event</div>
                        <div class='row'>
                            <div class="col-md-12 blockchart" id="chart_disaster" >
                                <!-- BAR CHART -->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3" style="font-size: 15px; color: grey; padding-top: 5px">
                        <div class="titleblock">Number of casualties</div>
                        <div class='row'>
                            <div class="col-md-12 blockchart" style="color: yellow" id="chart_casualties" >
                                <!-- BAR CHART -->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5" style="font-size: 15px; color: grey; padding-top: 5px">
                        <div class="titleblock">Number of affected + displaced population</div>
                        <div class='row'>
                            <div class="col-md-12 blockchart" id="chart_affected" >
                       		<!-- BAR CHART -->
                            </div>
                        </div>
                    </div>
                </div>
	            <footer>
                <div class="row">
                    <div class="col-md-10" style="padding-top: 30px; padding-left: 0px">
                        <div class="disclaimer">The boundaries and names shown and the designations used on this map do not imply official endorsement or acceptance by the United Nations.<br/>Please note that these figures are indicative and may be subject to change based on subsequent revisions by the Government.</div>
                    </div>
                    <div class="col-md-2" style="font-size: 15px; color: grey; padding-top: 25px">Powered by &nbsp;<a target="_blank" href="https://data.humdata.org/dataset/indonesia-monthly-humanitarian-update"><img class="img-responsive hdx" src='<?PHP echo $base_url?>images/HDX-logo-home.png'></a></div>
                </div>
	            </footer>
        </div>
        <br/><br/>

        <script src="https://d3js.org/d3.v3.min.js"></script>
        <script src="https://unpkg.com/leaflet@1.4.0/dist/leaflet.js"
   integrity="sha512-QVftwZFqvtRNi0ZyCtsznlKSWOStnDORoefr1enyq5mVL4tmKB3S/EnC3rRJcxCPavG10IcrVGSmPh6Qw5lwrg=="
   crossorigin=""></script>

        <!-- JAVASCRIPT LIBRARY -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.17/d3.min.js"></script>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

        <script src="https://api.tiles.mapbox.com/mapbox-gl-js/v0.53.0/mapbox-gl.js"></script>
        <script src="https://rawgit.com/mapbox/mapbox-gl-leaflet/master/leaflet-mapbox-gl.js"></script>

<script>
    var map = L.map('map', {
        center: [-2.0361833914499954,117.92711693632814],
        zoom: 5,
        // zoomDelta: 0.5,
        // zoomSnap: 0,
        zoomControl: true,
        // layerControl:false,
        attributionControl: false,
        // minZoom: zoom,
        // maxZoom: 19,
    });
        mapLink ='<a https://server.arcgisonline.com">OpenStreetMap</a>';

    // var tiles = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/Canvas/World_Light_Gray_Base/MapServer/tile/{z}/{y}/{x}', {attribution: 'Tiles &copy; Esri &mdash; Esri, DeLorme, NAVTEQ, BNPB, OCHA',maxZoom: 7,minZoom:4});
    // tiles.addTo(map);
    var tiles = L.mapboxGL({
        accessToken: 'pk.eyJ1IjoidGhhbXJpbmYiLCJhIjoiYzA1MmJjMzI1N2E5NzNhN2I2MzU4MDkzZWU4ODQxNzAifQ.3qQApYaqLA0bGC3Z5PCnUg',
        style: 'mapbox://styles/mapbox/light-v9',
        zIndex: 1,
    }).addTo(map);


    map.scrollWheelZoom.disable();

    
    var disasterCountPerProv = [];
    var Maxtotaldisaster = 0;  
    var totalCasualties = 0;
    var totalAffected = 0;
    var totalInjured = 0;
    EventCount = 0;

    var humanNumberRead = d3.format(",d");
    var numdisaster = [];
    var numaffected = [];
    var numcasualtiesvar = [];
    var tabledisaster=[['Disaster','Total']];
    var tableaffected=[['Disaster','Total']];
    var tablecasualties=[['Disaster','Total']];
    var selectedyear = 0;
    var selectedmonth = 0;


    $(document).ready(function(){
        selectedyear = new Date();
            selectedyear = selectedyear.getFullYear();
        for(var i=2018; i<=parseInt(selectedyear); i++){
            $('#theyear').append('<option value="'+i+'">'+i+'</option>');
        }

        var monthNames = ["January", "February", "March", "April", "May", "June","July", "August", "September", "October", "November", "December"];

        var d = new Date();
        if(d.getMonth() !=0){
            selectedmonth = monthNames[d.getMonth() - 1];
        }else{
            selectedmonth = monthNames[11];
            selectedyear -=1;
        }
        
        $('#themonth option[value='+selectedmonth+']').attr('selected','selected');
        $('#theyear option[value='+selectedyear+']').attr('selected','selected');

        calltext();
        geojson();
    })

function geojson(){
    // add geojson
    d3.json('IDN-admin12014-resize2.json',function(geojson){

        function style(feature) {
            return {
                weight: 0.5,
                opacity: 1,
                color: '#C0C0C0',
                dashArray: '0',
                fillOpacity: 0.7,
                fillColor: 'transparent',
                className:'our-choropleth',
            };
        }

        function highlightFeature(e) {
            var layer = e.target;

            layer.setStyle({
                weight: 1,
                color: '#C0C0C0',
                dashArray: '',
                fillOpacity: 0.7
            });

            if (!L.Browser.ie && !L.Browser.opera && !L.Browser.edge) {
                layer.bringToFront();
            }

        }

        function resetHighlight(e) {
            choropleth.resetStyle(e.target);
        }

        function zoomToFeature(e) {
            // map.fitBounds(e.target.getBounds());
        }

        function onEachFeature(feature, layer) {
            layer.on({
                mouseover: highlightFeature,
                mouseout: resetHighlight,
                click: zoomToFeature
            });
        }

        choropleth = L.geoJson(geojson, {
            style: style,
            onEachFeature: onEachFeature
        }).addTo(map);

        callthedata();

    })
}


$('#themonth').on('change',function(){
    changedate();
})
$('#theyear').on('change',function(){
    changedate();
})
function changedate(){
    $('.disastermarker').remove();
    $('.blockchart').html('');

    selectedmonth = $('#themonth').val();
    selectedyear = $('#theyear').val();
    callthedata();
    calltext();
}

function calltext(){
    $('.pmap').html('No data available at selected period, please select different month or year');
    d3.csv('https://docs.google.com/spreadsheets/d/e/2PACX-1vRvfXh_UWOqTY12zNZRLA9AYQdM9VHeG5CjqGI-LNMhBzwaH6uJ43KimulrCafnXtFxh9SaBFemMsfi/pub?output=csv',function(data){
        data.forEach(function(d,i){
            if(d.Period == selectedmonth+' '+selectedyear){
                $('.pmap').html(d.text);
            }
        })
    })
}

function callthedata(){
    EventCount = 0;
    disasterCountPerProv = []; 
    disasterCount = [];
    Maxtotaldisaster = 0;  
    totalCasualties = 0;
    totalAffected = 0;
    totalInjured =0;
    numdisaster = [];
    numaffected = [];
    numcasualtiesvar = [];
    tabledisaster=[];
    tableaffected=[];
    tablecasualties=[];
    var isavailable = 0;

    // call data from sheet
    d3.csv('https://docs.google.com/spreadsheets/d/e/2PACX-1vQv9WM_ZZHnqMpI0U4NIXApa3rB99lNhOgoYCb4ZelWXShSh2msEvLwXNpgukhcgDbYGNRNcZaHMNvG/pub?output=csv',function(data){
        data.forEach(function(d,i){

            if(d.Period == selectedmonth+' '+selectedyear){
                isavailable = 1;
                if( !numdisaster[d.Event] ){
                    numdisaster[d.Event] = 1 
                }else{
                    numdisaster[d.Event]+=1
                }

                if( !numaffected[d.Event] ){
                    if(d.Affected){
                        numaffected[d.Event] = parseInt(d.Affected)
                    }else{
                        numaffected[d.Event] = 0;
                    }
                }else{
                    if(d.Affected){
                        numaffected[d.Event] += parseInt(d.Affected)
                    }
                }

                if ( !numcasualtiesvar[d.Event] ){
                	if(d.Casualties){
                		numcasualtiesvar[d.Event] = parseInt(d.Casualties)
                	}else{
                		numcasualtiesvar[d.Event] = 0;
                	}
               	}else{
               		if(d.Casualties){
               			numcasualtiesvar[d.Event] += parseInt(d.Casualties)
               		}
               	}

                if(!disasterCountPerProv[d.IDPROV]){
                    disasterCountPerProv[d.IDPROV] = {'Drought':0,'Earthquake':0,'Earthquake and Tsunami':0, 'Fires':0, 'Flood':0, 'Forest Fires': 0,'Landslide':0, 'Tsunami':0,'Volcano Eruption':0, 'Whirlwind':0,'Total':0,'coor':{},'IDPROV':d.IDPROV,'Province':d.Province}
                }
                
                disasterCountPerProv[d.IDPROV][d.Event] += 1; 
                disasterCountPerProv[d.IDPROV].Total +=1;
                disasterCountPerProv[d.IDPROV].coor = {'lat':d.Ycoord,'lon':d.Xcoord};
                
                if(d.Casualties && parseInt(d.Casualties)){
                    totalCasualties+= parseInt(d.Casualties);
                }
                if(d.Affected && parseInt(d.Affected)){
                    totalAffected += parseInt(d.Affected);
                }
                if(d.Injured && parseInt(d.Injured)){
                    totalInjured += parseInt(d.Injured);
                }
                if(d.Event){
                    EventCount += 1;
                }
            }
        })
        if(!isavailable){
            alert('No data is available at the selected period, please select different month or year');
            calltext();
        }

        $('#valcasualites').html(humanNumberRead(totalCasualties));
        $('#valaffected').html(humanNumberRead(totalAffected));
        $('#valinjured').html(humanNumberRead(totalInjured));
        $('#valevent').html(humanNumberRead(EventCount));

        // loop for bubble on map
        disasterCountPerProv.forEach(function(d){
            if(Maxtotaldisaster < d.Total){
                Maxtotaldisaster = d.Total
            }
        })
        function getradius(val){
            var clus = Maxtotaldisaster/5;
            var radius = 0;
            if(val > clus*4){
                radius = 40;
            }else if(val > clus*3){
                radius = 30;
            }else if(val > clus*2){
                radius = 20;
            }else if(val > clus*1){
                radius = 10;
            }else{
                radius = 5;
            }
            return radius;
        }
        
        disasterCountPerProv.forEach(function(d){
            
            var html = '<b class="ttn">'+d.Province+' PROVINCE</b><br/>';
                html += '<font class="ttt">Number of Disaster : '+d.Total+'</font>'+'<hr/ class="hrtooltip">';

            var sortable = [];
            for (x in d) {
                sortable.push([x, d[x]]);
            }

            sortable.sort(function(a, b) {
                return b[1] - a[1];
            });

            sortable.forEach(function(d,v){
                x = d[0];
                z = d[1];
                if(x != 'Total' && x!='coor' && x!='IDPROV' && x!='Province'){
                   html += '<font class="ttv">'+x+' : '+z+'</font>'+'<br/>';
                }
            })

            var circle = L.circleMarker([d.coor.lat,d.coor.lon], {
                color: 'transparent',
                fillColor: 'orange',
                className: 'disastermarker',
                fillOpacity: 0.5,
                radius: getradius(d.Total)
            }).addTo(map).bindPopup(html);
        })

        function sortFunction(a, b) {
            if (a[1] === b[1]) {
                return 0;
            }
            else {
                return (a[1] < b[1]) ? 1 : -1;
            }
        }
        for(x in numdisaster){
            tabledisaster.push([x,numdisaster[x]]);
        }
        for(x in numaffected){
            tableaffected.push([x,numaffected[x]]);
        }
        for(x in numcasualtiesvar){
            tablecasualties.push([x,numcasualtiesvar[x]]);
        }

        tabledisaster.sort(sortFunction);
        tabledisaster.unshift(['Disaster','Total'])

        tablecasualties.sort(sortFunction);
        tablecasualties.unshift(['Disaster','Total'])

        tableaffected.sort(sortFunction);
        tableaffected.unshift(['Disaster','Total'])

        numdisevent();
        numdisaffected();
        numcasualties();

    })
}

    
    function numdisevent(){
        google.charts.load('current', {packages: ['corechart', 'bar']});
        google.charts.setOnLoadCallback(drawBasic);

        function drawBasic() {

              var data = google.visualization.arrayToDataTable(tabledisaster);

              var options = {
                colors:['#5592ce'],
                chartArea: {top:10,left:100,bottom:30,width: '70%'},
                hAxis: {
                  minValue: 0
                },
                vAxis: {
                  // title: 'Disaster'
                },
                legend:{
                    position:'none'
                }
              };

              var chart = new google.visualization.BarChart(document.getElementById('chart_disaster'));
              chart.draw(data, options);
            }

    }

	function numcasualties(){
        google.charts.load('current', {packages: ['corechart', 'bar']});
        google.charts.setOnLoadCallback(drawBasic);

        function drawBasic() {

              var data = google.visualization.arrayToDataTable(tablecasualties);

              var options = {
                colors:['#5592ce'],
                chartArea: {top:10,left:100,bottom:30,width: '70%'},
                hAxis: {
                  minValue: 0
                },
                vAxis: {
                  // title: 'Disaster'
                },
                legend:{
                    position:'none'
                }
              };

              var chart = new google.visualization.BarChart(document.getElementById('chart_casualties'));
              chart.draw(data, options);
            }
	}

    function numdisaffected(){
        google.charts.load('current', {packages: ['corechart', 'bar']});
        google.charts.setOnLoadCallback(drawBasic);

        function drawBasic() {

              var data = google.visualization.arrayToDataTable(tableaffected);

              var options = {
                colors:['#5592ce'],
                chartArea: {top:10,left:100,bottom:30,width: '70%'},
                hAxis: {
                  minValue: 0
                },
                vAxis: {
                  // title: 'Disaster'
                },
                legend:{
                    position:'none'
                }
              };

              var chart = new google.visualization.BarChart(document.getElementById('chart_affected'));
              chart.draw(data, options);
            }
    }

    

</script>


</body>
</html>
