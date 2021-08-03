
<div class="filter" id="filterIcon">
    <img width="100%" height="100%" src="{{URL::asset('images/filter.png')}}">
</div>

<div class="mobile-filter hidden">
    <div class="row" style="margin-top: 20%">

        <div class="col-xs-12">
            <input type="checkbox" onchange="changeFilterStatus(this.id, 'استان')" id="stateFilter">
            <label for="stateFilter">
                <span>استان</span>
            </label>
        </div>
        <div class="col-xs-12">
            <input type="checkbox" onchange="changeFilterStatus(this.id, 'رشته')" id="fieldFilter">
            <label for="fieldFilter">
                <span>رشته</span>
            </label>
        </div>
    </div>
</div>

<script>

    var filters = [];
    var filtersIds = [];
    var findMySuggestionsWithConstraint = '{{route('findMySuggestionsWithConstraint')}}';
    var selectedUId;
    var followDir = '{{route('submitRequest')}}';
    var rejectDir = '{{route('reject')}}';

    function checkOverFlow(val) {

        offsetHeight = $('#bio_' + val).prop('offsetHeight');
        scrollHeight = $('#bio_' + val).prop('scrollHeight');

        if (offsetHeight < scrollHeight)
            $('#more_' + val).removeClass('hidden');
        else
            $('#more_' + val).addClass('hidden');
    }

    function changeFilterStatus(id, val) {

        status = ($("#" + id).is(':checked')) ? 1 : 0;
        allow = false;

        for (i = 0; i < filters.length; i++) {
            if(filters[i] == val) {
                allow = true;
                if(status == 0) {
                    filters.splice(i, 1);
                    filtersIds.splice(i, 1);
                    break;
                }
            }
        }

        if(!allow && status == 1) {
            filters[filters.length] = val;
            filtersIds[filtersIds.length] = id;
        }

        showFilters();
    }
    
    function reOrderUsers() {

        fieldSort = stateSort = -1;

        if($("#stateFilter").is(':checked'))
            fieldSort = 1;

        if($("#fieldFilter").is(':checked'))
            stateSort = 1;

        $.ajax({
            type: 'post',
            url: findMySuggestionsWithConstraint,
            data: {
                'fieldSort': fieldSort,
                'stateSort': stateSort
            },
            success: function (response) {

                $("#users").empty();
                if(response.length != 0)
                    showUsers(JSON.parse(response));
            }
        });

    }

    function showUsers(arr) {

        newElement = "";

        if(arr.length == 0) {
            newElement += "<div class='col-xs-12 error'>";
            newElement += "<p>دوستی برای پیشنهاد یافت نشد</p>";
            newElement += "</div>";
        }

        for(i = 0; i < arr.length; i++) {
            newElement += "<div class='col-xs-12 invitationPane' onclick='showMoreInfo(\"" + arr[i].firstName + "\", \"" + arr[i].lastName + "\", \"" + arr[i].bio + "\", \"" + arr[i].photo + "\", \"" + arr[i].uId + "\", \"" + arr[i].state + "\", \"" + arr[i].field + "\")'>";
            newElement += '<div class="col-xs-4">';
            newElement += "<img width='100%' class='friendPhoto' src='" + arr[i].photo + "'>";
            newElement += "</div>";
            newElement += "<div class='col-xs-8'>";
            newElement += "<p>" + arr[i].firstName + "<span>&nbsp;</span>" + arr[i].lastName +  "</p>";
            newElement += "<p id='bio_" + arr[i].uId + "' style='max-height: 20px; line-height: 18px; overflow: hidden'>";
            newElement += "<span style='width: 90%'>" + arr[i].bio + "</span>";
            newElement += "<span style='position: absolute; top: 30%; width: 10%' class='more_" + arr[i].uId + "' class='hidden'>...</span>";
            newElement += "</p>";
            newElement += "<p>" + arr[i].field + "<span>|</span> " + arr[i].state + "</p>";
            newElement += "</div>";
            newElement += "</div>";
        }

        $("#users").append(newElement);

        for(i = 0; i < arr.length; i++)
            checkOverFlow(arr[i].uId);
    }

    function showMoreInfo(firstName, lastName, bio, photo, id, state, field) {

        $("#firstName").empty().append(firstName);
        $("#lastName").empty().append(lastName);
        $("#bio").empty().append(bio);
        $("#photo").attr('src', photo);
        $("#field").empty().append(field);
        $("#state").empty().append(state);
        selectedUId = id;

        $(".dark").removeClass('hidden');
        $("#showMoreInfo").removeClass('hidden');
    }

    function follow(mode) {
        $.ajax({
            type: 'post',
            url: followDir,
            data: {
                'uId': selectedUId,
                'mode': mode
            },
            success: function (response) {

                $("#showMoreInfo").addClass('hidden');
                $(".dark").addClass('hidden');

                if(response == "ok") {
                    reOrderUsers();
                }
            }
        });
    }
    
    function reject() {
        
        $.ajax({
            type: 'post',
            url: rejectDir,
            data: {
                'uId': selectedUId
            },
            success: function (response) {

                $("#showMoreInfo").addClass('hidden');
                $(".dark").addClass('hidden');

                if(response == "ok") {
                    reOrderUsers();
                }
            }
        });
    }
    
    function deleteFilter(idx) {
        if(idx > -1) {
            $("#" + filtersIds[idx]).removeAttr('checked');
            filters.splice(idx, 1);
            filtersIds.splice(idx, 1);
        }
        showFilters();
    }
    
    function showFilters() {

        $("#selectedFilters").empty();
        newElement = "";

        for(i = 0; i < filters.length; i++)
            newElement += "<span style='border: 2px solid white; float: right; margin-right: 5px; color: white; border-radius: 6px; max-width: 100px'><span onclick='deleteFilter(" + i + ")' class='glyphicon glyphicon-remove'></span><span>" + filters[i] + "</span></span>";

        $("#selectedFilters").append(newElement);

        reOrderUsers();
    }

    $(document).ready(function () {
       reOrderUsers();
    });
    
    $("#filterIcon").click(function () {
        if($(".mobile-filter").hasClass('hidden'))
            $(".mobile-filter").removeClass('hidden');
        else
            $(".mobile-filter").addClass('hidden');
    });

</script>