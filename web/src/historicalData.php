<!DOCTYPE HTML>
<html>
  <head>
    <title>ESP32 SALLE DE COMMANDE/SUPERVISION</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
      html {font-family: Arial; display: inline-block; text-align: center;}
      p {font-size: 1.2rem;}
      h4 {font-size: 0.8rem;}
      body {margin: 0;}

             .back-video {
      position: absolute;
      right: 0;
      bottom: 0;
      z-index: -1;
    }
    @media (min-aspect-ratio :16/9)
    {
      .back-video{
        width: 100%;
        height: auto;

      }
    }
      /* ----------------------------------- TOPNAV STYLE */
      .topnav {overflow: hidden; background-color: #000000ad; color: #c4ffbfe5; font-size: 1.2rem;}
      /* ----------------------------------- */
      
      /* ----------------------------------- TABLE STYLE */
      .styled-table {
        border-collapse: collapse;
        margin-left: auto; 
        margin-right: auto;
        font-size: 0.9em;
        font-family: sans-serif;
        min-width: 400px;
        box-shadow: 0 0 10px rgba(28, 179, 164, 0.72);
        border-radius: 0.5em;
        overflow: hidden;
        width: 90%;
      }

      .styled-table thead tr {
        background-color:#000000ab;
        color: #43ff57;
        text-align: left;
      }

      .styled-table th {
        padding: 12px 15px;
        text-align: left;
      }

      .styled-table td {
        padding: 12px 15px;
        text-align: left;
      }

      .styled-table tbody tr:nth-of-type(even) {
        background-color: #f3f3f3;
      }

      .styled-table tbody tr.active-row {
        font-weight: bold;
        color:#43ff57;
      }

      .bdr {
        border-right: 1.5px solid #65ff7d;
        border-left: 1px solid #65ff7d
      }
      
      td:hover {background-color: rgba(12, 105, 128, 0.21);}
      tr:hover {background-color: rgba(12, 105, 128, 0.15);}
      .styled-table tbody tr:nth-of-type(even):hover {background-color: rgba(12, 105, 128, 0.15);}
      /* ----------------------------------- */
      
      /* ----------------------------------- BUTTON STYLE */
      .btn-group .button {
        background-color: #0d1a0cab; /* Green */
        border: 1px solid #3a7335 ; 
        color: #bbe8c4e3;
        padding: 5px 8px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 14px;
        cursor: pointer;
        float: center;
      }

      .btn-group .button:not(:last-child) {
        border-right: none; /* Prevent double borders */
      }

      .btn-group .button:hover {
        background-color: #3a7335;
      }

      .btn-group .button:active {
        background-color: #0c6980;
        transform: translateY(1px);
      }

      .btn-group .button:disabled,
      .button.disabled{
        color:#9afd91d9;
        background-color: #0d1a0cab; 
        cursor: not-allowed;
        pointer-events:none;
      }

            footer {
  text-align: center;
  margin-top: -22px;
  color: #ffffffd6;
      /* ----------------------------------- */
    </style>
  </head>
  
  <body>

                 <video autoplay loop muted plays-inline class="back-video">
        <source src="VBG.mp4" type="video/mp4">
    </video>
    <div class="topnav">
      <h3>ESP32 SALLE DE COMMANDE/SUPERVISION</h3>
    </div>
    
    <br>
    
    <h3 style="color: #9affd9db;">HISTORIQUE DES DONNEES</h3>
    
    <table class="styled-table" id= "table_id">
      <thead>
        <tr>
          <th>NO</th>
          <th>ID</th>
          <th>BOARD</th>
          <th>TEMPERATURE (°C)</th>
          <th>HUMIDITE (%)</th>
          <th>STATUS READ SENSOR DHT11</th>
          <th>LED 01</th>
          <th>LED 02</th>
          <th>TIME</th>
          <th>DATE (dd-mm-yyyy)</th>
        </tr>
      </thead>
      <tbody id="tbody_table_record">
        <?php
          include 'database.php';
          $num = 0;
          //----------- The process for displaying a record table containing the DHT11 sensor data and the state of the LEDs.
          $pdo = Database::connect();
          // This table is used to store and record DHT11 sensor data updated by ESP32. 
          // This table is also used to store and record the state of the LEDs, the state of the LEDs is controlled from the "index.html" page. 
          // To store data, this table is operated with the "INSERT" command, so this table will contain many rows.
          $sql = 'SELECT * FROM historicaldata ORDER BY date, time';

          foreach ($pdo->query($sql) as $row) {
    $date = date_create($row['date']);
    $dateFormat = date_format($date, "d-m-Y");
    $num++;

    echo '<tr>';
    echo '<td style="color: white;">' . $num . '</td>';
    echo '<td class="bdr" style="color: white;">' . $row['id'] . '</td>';
    echo '<td class="bdr" style="color: white;">' . $row['board'] . '</td>';
    echo '<td class="bdr" style="color: white;">' . $row['temperature'] . '</td>';
    echo '<td class="bdr" style="color: white;">' . $row['humidity'] . '</td>';
    echo '<td class="bdr" style="color: white;">' . $row['status_read_sensor_dht11'] . '</td>';
    echo '<td class="bdr" style="color: white;">' . $row['LED_01'] . '</td>';
    echo '<td class="bdr" style="color: white;">' . $row['LED_02'] . '</td>';
    echo '<td class="bdr" style="color: white;">' . $row['time'] . '</td>';
    echo '<td style="color: white;">' . $dateFormat . '</td>';
    echo '</tr>';
}


          Database::disconnect();
          //------------------------------------------------------------
        ?>
      </tbody>
    </table>
    
    <br>
    
    <div class="btn-group">
      <button class="button" id="btn_prev" onclick="prevPage()">Prev</button>
      <button class="button" id="btn_next" onclick="nextPage()">Next</button>
      <div style="display: inline-block; position:relative; border: 0px solid #e3e3e3; float: center; margin-left: 2px;;">
<p style="position:relative; font-size: 14.5px; color: #d5ffcf;"> Table : <span id="page">1/1 (Total Number of Rows = 1) | Number of Rows : </span></p>
      </div>
      <select name="number_of_rows" id="number_of_rows">
        <option value="10">10</option>
        <option value="25">25</option>
        <option value="50">50</option>
        <option value="100">100</option>
      </select>
      <button class="button" id="btn_apply" onclick="apply_Number_of_Rows()">Apply</button>
    </div>

    <br>
    
    <script>
      //------------------------------------------------------------
      var current_page = 1;
      var records_per_page = 10;
      var l = document.getElementById("table_id").rows.length
      //------------------------------------------------------------
      
      //------------------------------------------------------------
      function apply_Number_of_Rows() {
        var x = document.getElementById("number_of_rows").value;
        records_per_page = x;
        changePage(current_page);
      }
      //------------------------------------------------------------
      
      //------------------------------------------------------------
      function prevPage() {
        if (current_page > 1) {
            current_page--;
            changePage(current_page);
        }
      }
      //------------------------------------------------------------
      
      //------------------------------------------------------------
      function nextPage() {
        if (current_page < numPages()) {
            current_page++;
            changePage(current_page);
        }
      }
      //------------------------------------------------------------
      
      //------------------------------------------------------------
      function changePage(page) {
        var btn_next = document.getElementById("btn_next");
        var btn_prev = document.getElementById("btn_prev");
        var listing_table = document.getElementById("table_id");
        var page_span = document.getElementById("page");
       
        // Validate page
        if (page < 1) page = 1;
        if (page > numPages()) page = numPages();

        [...listing_table.getElementsByTagName('tr')].forEach((tr)=>{
            tr.style.display='none'; // reset all to not display
        });
        listing_table.rows[0].style.display = ""; // display the title row

        for (var i = (page-1) * records_per_page + 1; i < (page * records_per_page) + 1; i++) {
          if (listing_table.rows[i]) {
            listing_table.rows[i].style.display = ""
          } else {
            continue;
          }
        }
          
        page_span.innerHTML = page + "/" + numPages() + " (Total Number of Rows = " + (l-1) + ") | Number of Rows : ";
        
        if (page == 0 && numPages() == 0) {
          btn_prev.disabled = true;
          btn_next.disabled = true;
          return;
        }

        if (page == 1) {
          btn_prev.disabled = true;
        } else {
          btn_prev.disabled = false;
        }

        if (page == numPages()) {
          btn_next.disabled = true;
        } else {
          btn_next.disabled = false;
        }
      }
      //------------------------------------------------------------
      
      //------------------------------------------------------------
      function numPages() {
        return Math.ceil((l - 1) / records_per_page);
      }
      //------------------------------------------------------------
      
      //------------------------------------------------------------
      window.onload = function() {
        var x = document.getElementById("number_of_rows").value;
        records_per_page = x;
        changePage(current_page);
      };
      //------------------------------------------------------------
    </script>

         <h1><footer>Powered By ringBuffer@TM</footer></h1>

  </body>
</html>