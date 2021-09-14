<DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" />
        <link rel="stylesheet" href="./assets/stylesheets/style.css" />
        <title>Todo List</title>
    </head>
    <body>
        <?= @$sContent ?>
        <div id="calendarModal" class="modal fade">
            <form id="update" action="" method="POST">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 id="titleTask">Update task</h4>
                        </div>
                        <div id="modalBody" class="modal-body">
                            <label for="modalTitle">Title: </label>
                            <input id="modalId" name="id" class="imputModal" hidden type="input" class="form-control" placeholder="Enter title">
                            <input id="modalTitle" required name="title" type="input" class="form-control" placeholder="Enter title">
                            <br>
                            <label for="modalTitle">Start date: </label>
                            <input type="datetime-local" required id="modalStart" name="start" class="form-control" placeholder="Enter Start date">
                            <br>
                            <label for="modalTitle">End date: </label>
                            <input type="datetime-local" required id="modalEnd" name="end" class="form-control" placeholder="Enter End date">
                            <br>
                            <label for="modalTitle">Status: </label>
                            <select class="custom-select mr-sm-2" id="modalStatus" name="status">
                                <option value="0" selected>Planning</option>
                                <option value="1">Doing</option>
                                <option value="2">Complete</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" id="btn-delete" class="btn btn-danger">Delete task</button>
                            <button type="submit" class="btn btn-default">Submit</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
    <script>
        $(document).ready(function() {
            var calendar = $('#calendar').fullCalendar({
                editable:true,
                header:{
                left:'prev,next today',
                center:'title',
                right:'month,agendaWeek,agendaDay'
                },
                initialView: 'listWeek',
                events: 'index.php?controller=pages&action=getAllListTask',
                eventColor: 'white',
                eventRender: function(info, element) {
                    if (info.status === '0') {
                        element.css('background-color', 'blue');
                    }
                    if (info.status === '1') {
                        element.css('background-color', 'green');
                    }
                    if (info.status === '2') {
                        element.css('background-color', 'red');
                    }
                    element.css('color', 'white');
                },
                selectable:true,
                selectHelper:true,
                select: function(start, end)
                {
                    $('#titleTask').html('Regist task');
                    $('#modalTitle').val('');
                    $('#btn-delete').hide();
                    $('#modalStatus').val(0);
                    $('#modalStart').val(start.toISOString());
                    $('#modalEnd').val(end.toISOString());
                    $('#update').attr('action','./index.php?controller=pages&action=home');
                    $('#calendarModal').modal();
                },
                editable:true,
                eventResize:function(event)
                {
                    var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                    var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
                    var status = event.status;
                    var title = event.title;
                    var id = event.id;
                    $.ajax({
                        url:"index.php?controller=pages&action=updateTask",
                        type:"POST",
                        data:{title:title, start:start, end:end, id:id, status:status},
                        success:function(){
                            calendar.fullCalendar('refetchEvents');
                            alert('Task Updated');
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            alert(textStatus);
                        }
                    })
                },
                eventDrop:function(event)
                {
                    var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                    var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
                    var status = event.status;
                    var title = event.title;
                    var id = event.id;
                    $.ajax({
                        url:"index.php?controller=pages&action=updateTask",
                        type:"POST",
                        data:{title:title, start:start, end:end, id:id, status:status},
                        success:function()
                        {
                            calendar.fullCalendar('refetchEvents');
                            alert("Task Updated");
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            alert(textStatus);
                        }
                    });
                },
                eventClick:  function(event) {
                    var id = event.id;
                    var title = event.title;
                    var start = event.start;
                    var end = event.end;
                    var status = event.status;
                    $('#btn-delete').show();
                    $('#btn-delete').attr("data-id", id);
                    $('#titleTask').html('Update task');
                    $('#modalId').val(id);
                    $('#modalTitle').val(title);
                    $('#modalStart').val(start.toISOString());
                    $('#modalEnd').val(end.toISOString());
                    $('#modalStatus').val(status);
                    $('#update').attr('action','./index.php?controller=pages&action=home');
                    $('#calendarModal').modal();
                },
                editable: true,
                dayMaxEvents: true,
            });
        });

        $(document).ready(function() {
            $("#btn-delete").click(function(){
                var deleteFlag = confirm("Press a button!");
                if (deleteFlag == true) {
                    var dataId = $(this).data("id");
                    $.ajax({
                        url: "./index.php?controller=pages&action=updateTask",
                        type: "POST",
                        data:{id:dataId,delete_flag:1},
                        success: function (response) {
                            if (response == 'true') {
                                alert("delete task successfully");
                            } else {
                                alert("delete task fail");
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            alert(textStatus);
                        }
                    });
                }
            });
        });
    </script>
</html>