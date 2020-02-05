

<footer class="mainfooter" role="contentinfo">
  <div class="footer-top p-y-2">
    <div class="container-fluid">
      <div class="row">
        
        <div class="col-md-12">
          <div class="footer-title text-xs-center">
          <h4 class="p-b-1">Altri Servizi</h4>
        </div>
        </div>
        <div class="col-md-2">
          <div class="card card-primary ">
          <a href="http://www.primisoft.com/primis/" target="_blank"/>
            <div class="card-header">Primis <span class="iconFooter" style="float:right; color:#6D6D6Dff; font-size:18px;"><i class="fas fa-tasks"></i></span> </div>
            </a>
          </div>
        </div><!--col-md-2-->
          <div class="col-md-2">
          <div class="card card-primary">
          <a href="http://tools.primisoft.com/" target="_blank"/>
            <div class="card-header">R.T.R - Primis Tool <span class="iconFooter" style="float:right; color:#6D6D6Dff; font-size:18px;">
            <i class="fas fa-stream"></i></span> 
          </div>
            </a>
          </div>
        </div><!--col-md-2-->
          <div class="col-md-2">
          <div class="card card-primary">
          <a href="http://ciro.interactive-mr.com/" target="_blank"/>
            <div class="card-header">C.I.R.O <span class="iconFooter" style="float:right; color:#6D6D6Dff; font-size:18px;">
            <i class="far fa-address-book"></i></span> 
          </div>
            </a>
          </div>
        </div><!--col-md-2-->
          <div class="col-md-2">
          <div class="card card-primary">
          <a href="http://interactive-mr.com/" target="_blank"/>
            <div class="card-header">Sito istituzionale <span class="iconFooter" style="float:right; color:#6D6D6Dff; font-size:18px;">
            <i class="fas fa-user-tie"></i></span> 
          </div>
            </a>
          </div>
        </div><!--col-md-2-->
          <div class="col-md-2">
          <div class="card card-primary">
          <a href="http://millebytes.com/" target="_blank"/>
            <div class="card-header">Club Millebytes <span class="iconFooter" style="float:right; color:#6D6D6Dff; font-size:18px;">
            <i class="fas fa-users"></i></span> 
          </div>
            </a>
          </div>
        </div><!--col-md-2-->
          <div class="col-md-2">
          <div class="card card-primary">
          <a href="https://www.facebook.com/Interactive-Market-Research-1510718559033340" target="_blank"/>
            <div class="card-header">Facebook <span class="iconFooter" style="float:right; color:#6D6D6Dff; font-size:18px;">
            <i class="fab fa-facebook"></i></span> 
          </div>
            </a>
          </div>
        </div><!--col-md-2-->
      </div>
    </div>
  </div>
  <div class="footer-bottom">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <!--Footer Bottom-->
          <p class="text-xs-center">&copy; Copyright 2010 - Interactive Market Research.</p>
        </div>
      </div>
    </div>
  </div>
</footer>




      <!-- FOOTER SECTION END-->
      
      
          <!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY  -->
    <script src="assets/js/jquery-1.10.2.js"></script>
        <!-- BOOTSTRAP SCRIPTS  -->
        <script src="assets/js/popper.min.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
      <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>

          <!-- CUSTOM all  -->
          <script src="assets/js/all.js"></script>

        <!-- TOOLTIP  -->   
        <script>
          $(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
        </script>  

<!-- datatables  -->   
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>

<script>

  //
// Pipelining function for DataTables. To be used to the `ajax` option of DataTables
//
$.fn.dataTable.pipeline = function ( opts ) {
    // Configuration options
    var conf = $.extend( {
        pages: 5,     // number of pages to cache
        url: '',      // script url
        data: null,   // function or object with parameters to send to the server
                      // matching how `ajax.data` works in DataTables
        method: 'GET' // Ajax HTTP method
    }, opts );
 
    // Private variables for storing the cache
    var cacheLower = -1;
    var cacheUpper = null;
    var cacheLastRequest = null;
    var cacheLastJson = null;
 
    return function ( request, drawCallback, settings ) {
        var ajax          = false;
        var requestStart  = request.start;
        var drawStart     = request.start;
        var requestLength = request.length;
        var requestEnd    = requestStart + requestLength;
         
        if ( settings.clearCache ) {
            // API requested that the cache be cleared
            ajax = true;
            settings.clearCache = false;
        }
        else if ( cacheLower < 0 || requestStart < cacheLower || requestEnd > cacheUpper ) {
            // outside cached data - need to make a request
            ajax = true;
        }
        else if ( JSON.stringify( request.order )   !== JSON.stringify( cacheLastRequest.order ) ||
                  JSON.stringify( request.columns ) !== JSON.stringify( cacheLastRequest.columns ) ||
                  JSON.stringify( request.search )  !== JSON.stringify( cacheLastRequest.search )
        ) {
            // properties changed (ordering, columns, searching)
            ajax = true;
        }
         
        // Store the request for checking next time around
        cacheLastRequest = $.extend( true, {}, request );
 
        if ( ajax ) {
            // Need data from the server
            if ( requestStart < cacheLower ) {
                requestStart = requestStart - (requestLength*(conf.pages-1));
 
                if ( requestStart < 0 ) {
                    requestStart = 0;
                }
            }
             
            cacheLower = requestStart;
            cacheUpper = requestStart + (requestLength * conf.pages);
 
            request.start = requestStart;
            request.length = requestLength*conf.pages;
 
            // Provide the same `data` options as DataTables.
            if ( typeof conf.data === 'function' ) {
                // As a function it is executed with the data object as an arg
                // for manipulation. If an object is returned, it is used as the
                // data object to submit
                var d = conf.data( request );
                if ( d ) {
                    $.extend( request, d );
                }
            }
            else if ( $.isPlainObject( conf.data ) ) {
                // As an object, the data given extends the default
                $.extend( request, conf.data );
            }
 
            settings.jqXHR = $.ajax( {
                "type":     conf.method,
                "url":      conf.url,
                "data":     request,
                "dataType": "json",
                "cache":    false,
                "success":  function ( json ) {
                    cacheLastJson = $.extend(true, {}, json);
 
                    if ( cacheLower != drawStart ) {
                        json.data.splice( 0, drawStart-cacheLower );
                    }
                    if ( requestLength >= -1 ) {
                        json.data.splice( requestLength, json.data.length );
                    }
                     
                    drawCallback( json );
                }
            } );
        }
        else {
            json = $.extend( true, {}, cacheLastJson );
            json.draw = request.draw; // Update the echo for each response
            json.data.splice( 0, requestStart-cacheLower );
            json.data.splice( requestLength, json.data.length );
 
            drawCallback(json);
        }
    }
};
 
// Register an API method that will empty the pipelined data, forcing an Ajax
// fetch on the next draw (i.e. `table.clearPipeline().draw()`)
$.fn.dataTable.Api.register( 'clearPipeline()', function () {
    return this.iterator( 'table', function ( settings ) {
        settings.clearCache = true;
    } );
} );
 
$(document).ready( function () {
  $('#table_sur').show();
    $('#table_sur').DataTable( {
        "order": [[ 11, "asc" ]],
        "pagingType": "full_numbers",
        "scrollY": false,
        "scrollX": false,
        "lengthMenu": [[10, 30, 100, -1], [10, 30, 100, "All"]],
        "pageLength": 30,
        'columnDefs': [ {

                        'targets': [1,2,12,13], /* column index */

                        'orderable': false, /* true or false */

                        }]
    } );
} );

</script>

</body>

</html>
