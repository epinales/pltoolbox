

<div class="container">
  <div style="height: 300px; padding: 20px;">
    <p>Follow this:</p>

    <ul>
      <li>Bootstrap CSS</li>
      <li>Bootstrap Datetimepicker CSS</li>
      <hr/>
      <li>Jquery</li>
      <li>Bootstrap Datetimepicker JS</li>
      <li>Your jquyery function</li>
    </ul>
  </div>
  <div class="row">
    <div class='col-sm-4'>
      <div class="form-group">
        <div class='input-group date' id='datetimepicker1'>
          <input type='text' class="form-control" />
          <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
          </span>
        </div>
      </div>
    </div>
    <div class='col-sm-4'>
      <div class="form-group">
        <div class='input-group date' id='datetimepicker2'>
          <input type='text' class="form-control" />
          <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
          </span>
        </div>
      </div>
    </div>
    <div class='col-sm-4'>
      <div class="form-group">
        <div class='input-group date' id='datetimepicker3'>
          <input type='text' class="form-control" />
          <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
          </span>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
$(function () {
    $('#datetimepicker1').datetimepicker({
      format: 'DD-MM-YYYY LT'
    });
    $('#datetimepicker2').datetimepicker({
      format: 'DD-MM-YYYY'
    });
    $('#datetimepicker3').datetimepicker({
      format: 'LT'
    });
    $('#datetimepicker3').datetimepicker({
      format: 'LT'
    });
  });
</script>
