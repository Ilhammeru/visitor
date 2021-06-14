<div class="container mt-5">
    <div class="row mt-5">
        <div class="col">
            <div class="card shadow">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Telfon</th>
                                </tr>
                            </thead>
                            <tbody id="target"></tbody>
                        </table>
                        <div class="pagination"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.pagination').on('click', 'a', function(e) {
            e.preventDefault();
            var pageno = $(this).attr('data-ci-pagination-page');
            getDataPagination(pageno);
        });
        getDataPagination(0);
    })

    function getDataPagination(page) {
        $.ajax({
            type: 'GET',
            url: '/visitor/pagination/loadRecord/' + page,
            dataType: 'json',
            success: function(data) {
                console.log(data);
                $('.pagination').html(data.pagination);
                createTable(data.result, data.row);
            }
        })
    }

    function createTable(data, no) {
        var no = Number(no);
        $('#targer').empty();
        var tr = '';
        for (index in data) {
            var id = data[index].id_visit;
            var title = data[index].nama;
            // var content = result[index].slug;
            // content = content.substr(0, 60) + " ...";
            var link = data[index].slug;
            no += 1;

            tr += "<tr>" +
                "<td>" + no + "</td>" +
                "<td>" + title + "</td>" +
                "</tr>";
        }
        $('#target').html(tr);
    }
</script>