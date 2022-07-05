@extends('layouts.admin-base')

@section('content')
    <style>
        #chartdiv {
            width: 100%;
            height: 60vh;
            overflow: hidden;
        }

        .map-marker {
            /* adjusting for the marker dimensions
            so that it is centered on coordinates */
            margin-left: -8px;
            margin-top: -8px;
        }
        .map-marker.map-clickable {
            cursor: pointer;
        }
        .pulse {
            width: 10px;
            height: 10px;
            border: 5px solid #f7f14c;
            -webkit-border-radius: 30px;
            -moz-border-radius: 30px;
            border-radius: 30px;
            background-color: #716f42;
            z-index: 10;
            position: absolute;
        }
        .map-marker .dot {
            border: 10px solid #fff601;
            background: transparent;
            -webkit-border-radius: 60px;
            -moz-border-radius: 60px;
            border-radius: 60px;
            height: 50px;
            width: 50px;
            -webkit-animation: pulse 3s ease-out;
            -moz-animation: pulse 3s ease-out;
            animation: pulse 3s ease-out;
            -webkit-animation-iteration-count: infinite;
            -moz-animation-iteration-count: infinite;
            animation-iteration-count: infinite;
            position: absolute;
            top: -20px;
            left: -20px;
            z-index: 1;
            opacity: 0;
        }
        @-moz-keyframes pulse {
            0% {
                -moz-transform: scale(0);
                opacity: 0.0;
            }
            25% {
                -moz-transform: scale(0);
                opacity: 0.1;
            }
            50% {
                -moz-transform: scale(0.1);
                opacity: 0.3;
            }
            75% {
                -moz-transform: scale(0.5);
                opacity: 0.5;
            }
            100% {
                -moz-transform: scale(1);
                opacity: 0.0;
            }
        }
        @-webkit-keyframes "pulse" {
            0% {
                -webkit-transform: scale(0);
                opacity: 0.0;
            }
            25% {
                -webkit-transform: scale(0);
                opacity: 0.1;
            }
            50% {
                -webkit-transform: scale(0.1);
                opacity: 0.3;
            }
            75% {
                -webkit-transform: scale(0.5);
                opacity: 0.5;
            }
            100% {
                -webkit-transform: scale(1);
                opacity: 0.0;
            }
        }
    </style>

    <!-- Resources -->
    <script src="https://www.amcharts.com/lib/4/core.js"></script>
    <script src="https://www.amcharts.com/lib/4/maps.js"></script>
    <script src="https://www.amcharts.com/lib/4/geodata/worldLow.js"></script>
    <script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>

    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i>Dashboard</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item active"><a href="#">dashboard</a></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title">Location Distribution</h3>
                <div class="tile-body">
                    <div id="chartdiv"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-lg-3">
            <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
                <div class="info">
                    <h4>Users</h4>
                    <p><b>{{$user_count}}</b></p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="widget-small info coloured-icon"><i class="icon fa fa-thumbs-o-up fa-3x"></i>
                <div class="info">
                    <h4>Assessments</h4>
                    <p><b>{{$assessment_count}}</b></p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="widget-small warning coloured-icon"><i class="icon fa fa-files-o fa-3x"></i>
                <div class="info">
                    <h4>Downloads</h4>
                    <p><b>{{$download_count}}</b></p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="widget-small danger coloured-icon"><i class="icon fa fa-star fa-3x"></i>
                <div class="info">
                    <h4>High Rates</h4>
                    <p><b>{{$assessment_rate_count}}</b></p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="tile">
                <h3 class="tile-title">Monthly Assessments</h3>
                <div class="embed-responsive embed-responsive-16by9">
                    <canvas class="embed-responsive-item" id="lineChartDemo"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="tile">
                <h3 class="tile-title">Rating Distribution</h3>
                <div class="embed-responsive embed-responsive-16by9">
                    <canvas class="embed-responsive-item" id="pieChartDemo"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>

        am4core.useTheme(am4themes_animated);
        // Themes end

        // Create map instance
        var chart = am4core.create("chartdiv", am4maps.MapChart);

        // Set map definition
        chart.geodata = am4geodata_worldLow;

        // Set projection
        chart.projection = new am4maps.projections.Miller();

        // Create map polygon series
        var polygonSeries = chart.series.push(new am4maps.MapPolygonSeries());

        // Exclude Antartica
        polygonSeries.exclude = ["AQ"];

        // Make map load polygon (like country names) data from GeoJSON
        polygonSeries.useGeodata = true;

        // Configure series
        var polygonTemplate = polygonSeries.mapPolygons.template;
        polygonTemplate.tooltipText = "{name}";
        polygonTemplate.fill = chart.colors.getIndex(0).lighten(0.5);

        // Create hover state and set alternative fill color
        var hs = polygonTemplate.states.create("hover");
        hs.properties.fill = chart.colors.getIndex(0);

        // Add image series
        var imageSeries = chart.series.push(new am4maps.MapImageSeries());
        imageSeries.mapImages.template.propertyFields.longitude = "longitude";
        imageSeries.mapImages.template.propertyFields.latitude = "latitude";

        // this function will take current images on the map and create HTML elements for them
        function updateCustomMarkers( event ) {

            // go through all of the images
            imageSeries.mapImages.each(function(image) {
                // check if it has corresponding HTML element
                if (!image.dummyData || !image.dummyData.externalElement) {
                    // create onex
                    image.dummyData = {
                        externalElement: createCustomMarker(image)
                    };
                }

                // reposition the element accoridng to coordinates
                var xy = chart.geoPointToSVG( { longitude: image.longitude, latitude: image.latitude } );
                image.dummyData.externalElement.style.top = xy.y + 'px';
                image.dummyData.externalElement.style.left = xy.x + 'px';
            });

        }

        // this function creates and returns a new marker element
        function createCustomMarker( image ) {

            var chart = image.dataItem.component.chart;

            // create holder
            var holder = document.createElement( 'div' );
            holder.className = 'map-marker';
            holder.title = image.dataItem.dataContext.title;
            holder.style.position = 'absolute';

            // maybe add a link to it?
            if ( undefined != image.url ) {
                holder.onclick = function() {
                    window.location.href = image.url;
                };
                holder.className += ' map-clickable';
            }

            // create dot
            var dot = document.createElement( 'div' );
            dot.className = 'dot';
            holder.appendChild( dot );

            // create pulse
            var pulse = document.createElement( 'div' );
            pulse.className = 'pulse';
            holder.appendChild( pulse );

            // append the marker to the map container
            chart.svgContainer.htmlElement.appendChild( holder );

            return holder;
        }

        function viewMap(data){
            // Themes begin
            var imageSeries_data = [];

            for(var i=0;i<data.length;i++){
                imageSeries_data.push(
                    {
                        "zoomLevel": 5,
                        "scale": 0.5,
                        "title": data[i]["country"] + ", " + data[i]["city"],
                        "latitude": data[i]["latitude"],
                        "longitude": data[i]["longitude"]
                    }
                );
            }

            imageSeries.data = imageSeries_data;

            // add events to recalculate map position when the map is moved or zoomed
            chart.events.on( "mappositionchanged", updateCustomMarkers );
        }

        $(document).ready(function() {
            var success = function (data) {
                   viewMap(data);
                },
                error = function (data) {
                    swal({
                        type: 'error',
                        title: "{{__("An error occurred.")}}",
                        text: data,
                    })
                };
            ajax_json(
                "POST",
                "{{route("admin.getAssessmentInfo")}}",
                {
                    _token: "{{csrf_token()}}",
                },
                success,
                error,
                true
            );
        });
    </script>

    <script src="{{ asset('js/plugins/pace.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('js/plugins/chart.js')}}"></script>
    <script type="text/javascript">
        var now_date = new Date();
        var view_labels=[];
        function formatDate(date) {
            var d = new Date(date),
                month = '' + (d.getMonth() + 1),
                year = d.getFullYear();
            if (month.length < 2) month = '0' + month;
            return [year, month].join('-');
        }

        for(var i=0;i<5;i++){
            view_labels.unshift(formatDate(now_date));
            now_date.setMonth(now_date.getMonth() - 1);
        }
        var data = {
            labels: view_labels,
            datasets: [
                {
                    label: "My Second dataset",
                    fillColor: "rgba(151,187,205,0.2)",
                    strokeColor: "rgba(151,187,205,1)",
                    pointColor: "rgba(151,187,205,1)",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(151,187,205,1)",
                    data: [
                        parseInt('{{$assessment_month_dist->mon_4}}'),
                        parseInt('{{$assessment_month_dist->mon_3}}'),
                        parseInt('{{$assessment_month_dist->mon_2}}'),
                        parseInt('{{$assessment_month_dist->mon_1}}'),
                        parseInt('{{$assessment_month_dist->mon_0}}'),
                    ]
                }
            ]
        };
        var pdata = [
            {
                value: parseInt('{{$assessment_rate_dist->count_25}}'),
                color: "#ff6666",
                highlight: "#ffaaaa",
                label: "0~25% Rate"
            },
            {
                value: parseInt('{{$assessment_rate_dist->count_50}}'),
                color:"#ffff66",
                highlight: "#ffffaa",
                label: "25~50% Rate"
            },{
                value: parseInt('{{$assessment_rate_dist->count_75}}'),
                color:"#ffaa00",
                highlight: "#ffcc00",
                label: "50~75% Rate"
            },{
                value: parseInt('{{$assessment_rate_dist->count_100}}'),
                color:"#66ff66",
                highlight: "#aaffaa",
                label: "75~100% Rate"
            },
        ]

        var ctxl = $("#lineChartDemo").get(0).getContext("2d");
        var lineChart = new Chart(ctxl).Line(data);

        var ctxp = $("#pieChartDemo").get(0).getContext("2d");
        var pieChart = new Chart(ctxp).Pie(pdata);
    </script>
@endsection
