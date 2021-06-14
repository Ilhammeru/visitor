<div class="container mt-5 pt-5">
  <div class="row">
    <div class="col-md-4 col-sm-4">
      <div class="form-group">
        <label for="">Pilih Tanggal : </label>
        <div class="input-group mb-3">
          <input type="text" class="form-control tanggalAwal" placeholder="Tanggal mulai" aria-label="Username">
          <span class="input-group-text">-</span>
          <input type="text" class="form-control tanggalAkhir" placeholder="Tanggal akhir" aria-label="Server" onchange="showKategori()">
        </div>
      </div>
    </div>
    <div class="col-md-3 col-sm-3 kategoriGroup" hidden>
      <div class="form-group">
        <label for="">Kategori</label>
        <select name="kategori" class="form-control kategori" onchange="showRekap()">
          <option value="">-- Pilih --</option>
          <option value="4">Semua</option>
          <option value="3">Respon</option>
          <option value="2">No respon</option>
          <option value="1">Anak - anak</option>
        </select>
      </div>
    </div>
  </div>

  <hr>

  <div>

    <div class="table-responsive">

      <div class="targetLoader">

      </div>

      <table class="table targetRekap table-bordered">

        <thead class="targetHeader">

        </thead>

        <tbody class="targetBody">
        </tbody>

      </table>

    </div>

  </div>

</div>

<!------------------------- modal -------------------------->


<div class="modal modalDetailVisitor fade" id="exampleModal">
  <div class="modal-dialog modal-fullscreen-sm-down modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title targetTitle" id="exampleModalLabel">Detail Rekap</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body targetKesimpulanRekap" style="max-height: 100%;">

        <div class="targetLoaderKesimpulan">

        </div>

        <div class="rekapRow" style="display: none;">

          <div class="container">

            <div class="row">

              <div class="col-md-5 col-sm-5">

                <div class="row">

                  <div class="col-12">

                    <div class="table-responsive">

                      <table class="table table-bordered">

                        <thead class="rekapThead">

                        </thead>

                        <tbody class="rekapTbody">

                        </tbody>

                      </table>

                    </div>

                  </div>

                </div>

                <div class="row">

                  <div class="col-12">

                    <div class="table-responsive">

                      <table class="table table-bordered">

                        <thead">
                          <th>IG</th>
                          <th>FB</th>
                          <th>Ayo</th>
                          <th>D.Franchise</th>
                          <th>Wara</th>
                          <th>Web</th>
                          <th>Direct</th>
                          </thead>

                          <tbody class="rekapSumber text-center">

                          </tbody>

                      </table>

                    </div>

                  </div>

                </div>

              </div>

              <div class="col-md-7 col-sm-7">

                <div class="responRow">

                  <div class="table-responsive">

                    <table class="table table-bordered" style="overflow-y: scroll; height: 54em; max-height: 54em; display: block;">

                      <thead>
                        <th>Tanggal</th>
                        <th>Nama</th>
                        <th>Hp</th>
                        <th>Kategori</th>
                        <th>Prospek</th>
                        <th>Alasan</th>
                        <th>Sumber</th>
                        <th>Aksi</th>
                      </thead>

                      <tbody class="targetDetailRespon">
                      </tbody>

                    </table>

                  </div>

                </div>

              </div>

            </div>

          </div>

        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!------------------------- modal -------------------------->

<script>
  $(document).ready(function() {
    $('.tanggalAwal').datepicker({
      autoclose: true,
      format: 'yyyy-mm-dd'
    });

    $('.tanggalAkhir').datepicker({
      autoclose: true,
      format: 'yyyy-mm-dd'
    })
  })

  function showKategori() {
    $('.kategoriGroup').removeAttr('hidden');
  }

  function showRekap() {
    var tanggalAwal = $('.tanggalAwal').val();
    var tanggalAkhir = $('.tanggalAkhir').val();
    var kategori = $('.kategori').val();

    $.ajax({
      type: 'POST',
      data: {
        kategori: kategori,
        tanggalAwal: tanggalAwal,
        tanggalAkhir: tanggalAkhir
      },
      url: '<?= base_url('rekap/showRekap'); ?>',
      dataType: 'json',
      beforeSend: function() {

        var x = '<div class="text-center">' +
          '<span>Loading ....</span> <br>' +
          '<div class="spinner-grow text-info m-1" role="status">' +
          '<span class="visually-hidden">Loading...</span>' +
          '</div>' +
          '<div class="spinner-grow text-warning m-1" role="status">' +
          '<span class="visually-hidden">Loading...</span>' +
          '</div>' +
          '<div class="spinner-grow text-danger m-1" role="status">' +
          '<span class="visually-hidden">Loading...</span>' +
          '</div>' +
          '<div class="spinner-grow text-success m-1" role="status">' +
          '<span class="visually-hidden">Loading...</span>' +
          '</div>' +
          '</div>';
        $('.targetLoader').html(x);
      },
      success: function(result) {
        console.log(result);
        $('.targetLoader').html('');

        var theadRespon = '';
        var tbodyRespon = '';
        var tbodyNoRespon = '';
        var tbodyAnak = '';
        var tbodyTotal = '';

        for (var i = 0; i < result.brandId.length; i++) {

          if (result.kategori == 4) {

            if (result.respon[i] == 0) {

              var respon = '-';

            } else {

              var respon = result.respon[i];

            }

            if (result.noRespon[i] == 0) {

              var noRespon = '-';

            } else {

              var noRespon = result.noRespon[i];

            }

            if (result.anak[i] == 0) {

              var anak = '-';

            } else {

              var anak = result.anak[i];

            }

          } else if (result.kategori == 3) {

            if (result.respon[i] == 0) {

              var respon = '-';

            } else {

              var respon = result.respon[i];

            }

          } else if (result.kategori == 2) {

            if (result.noRespon[i] == 0) {

              var noRespon = '-';

            } else {

              var noRespon = result.noRespon[i];

            }

          } else if (result.kategori == 1) {

            if (result.anak[i] == 0) {

              var anak = '-';

            } else {

              var anak = result.anak[i];

            }

          }


          if (result.total[i] == 0) {

            var total = '-';

          } else {

            var total = result.total[i];

          }

          var awal = "'" + tanggalAwal + "'";
          var akhir = "'" + tanggalAkhir + "'";
          var valueRespon = "'" + respon + "'";
          var valueNoRespon = "'" + noRespon + "'";
          var valueAnak = "'" + anak + "'";
          var dbName = "'" + result.dbName[i] + "'";

          // theadRespon += '<th style="text-align: center; text-transform: capitalize;">'+ result.brandName[i] +'</th>';

          if (result.kategori == 4) {

            theadRespon += '<th style="text-align: center; text-transform: capitalize; padding: 0 2em;">' + result.brandName[i] + '</th>';

            tbodyRespon += '<td onclick="detailBrand(' + dbName + ', ' + result.brandId[i] + ', ' + awal + ', ' + akhir + ', 3, ' + valueRespon + ')" style="text-align: center; padding: 0 2em;">' + respon + '</td>';

            tbodyNoRespon += '<td onclick="detailBrand(' + dbName + ', ' + result.brandId[i] + ', ' + awal + ', ' + akhir + ', 2, ' + valueNoRespon + ')" style="text-align: center; padding: 0 2em;">' + noRespon + '</td>';

            tbodyAnak += '<td onclick="detailBrand(' + dbName + ', ' + result.brandId[i] + ', ' + awal + ', ' + akhir + ', 1, ' + valueAnak + ')" style="text-align: center; padding: 0 2em;">' + anak + '</td>';

            tbodyTotal += '<td onclick="detailBrand(' + dbName + ', ' + result.brandId[i] + ', ' + awal + ', ' + akhir + ', 0)" style="text-align: center; font-weight: bolder; padding: 0 2em;">' + total + '</td>';

          } else if (result.kategori == 3) {

            theadRespon += '<th style="text-align: center; text-transform: capitalize;">' + result.brandName[i] + '</th>';

            tbodyRespon += '<td onclick="detailBrand(' + dbName + ', ' + result.brandId[i] + ', ' + awal + ', ' + akhir + ', 3, ' + valueRespon + ')" style="text-align: center;">' + respon + '</td>';

            tbodyTotal += '<td onclick="detailBrand(' + dbName + ', ' + result.brandId[i] + ', ' + awal + ', ' + akhir + ', 3)" style="text-align: center; font-weight: bolder;">' + total + '</td>';

          } else if (result.kategori == 2) {

            theadRespon += '<th style="text-align: center; text-transform: capitalize;">' + result.brandName[i] + '</th>';

            tbodyNoRespon += '<td onclick="detailBrand(' + dbName + ', ' + result.brandId[i] + ', ' + awal + ', ' + akhir + ', 2, ' + valueNoRespon + ')" style="text-align: center;">' + noRespon + '</td>';

            tbodyTotal += '<td onclick="detailBrand(' + dbName + ', ' + result.brandId[i] + ', ' + awal + ', ' + akhir + ', 2)" style="text-align: center; font-weight: bolder;">' + total + '</td>';

          } else if (result.kategori == 1) {

            theadRespon += '<th style="text-align: center; text-transform: capitalize;">' + result.brandName[i] + '</th>';

            tbodyAnak += '<td onclick="detailBrand(' + dbName + ', ' + result.brandId[i] + ', ' + awal + ', ' + akhir + ', 1, ' + valueAnak + ')" style="text-align: center;">' + anak + '</td>';

            tbodyTotal += '<td onclick="detailBrand(' + dbName + ', ' + result.brandId[i] + ', ' + awal + ', ' + akhir + ', 1)" style="text-align: center; font-weight: bolder;">' + total + '</td>';

          }


        }



        if (result.kategori == 4) {

          $('.targetHeader').html('');
          $('.targetBody').html('');

          $('.targetHeader').append('<th>Kategori</th>');
          $('.targetHeader').append(theadRespon);

          $('.targetBody').append('<tr class="respon"></tr>');
          $('.targetBody').append('<tr class="noRespon"></tr>');
          $('.targetBody').append('<tr class="anak"></tr>');
          $('.targetBody').append('<tr class="help"></tr>');
          $('.targetBody').append('<tr class="total"></tr>');

          $('.respon').append('<td>Respon</td>');
          $('.noRespon').append('<td>No Respon</td>');
          $('.anak').append('<td>Anak - anak</td>');
          $('.help').append('<td></td>');
          $('.total').append('<td>Total</td>');

          $('.respon').append(tbodyRespon);
          $('.noRespon').append(tbodyNoRespon);
          $('.anak').append(tbodyAnak);
          $('.help').append('<td colspan="' + result.brandName.length + '"></td>');
          $('.total').append(tbodyTotal);

        } else if (result.kategori == 3) {

          $('.targetHeader').html('');
          $('.targetBody').html('');

          $('.targetHeader').append('<th>Kategori</th>');
          $('.targetHeader').append(theadRespon);


          $('.targetBody').append('<tr class="respon"></tr>');
          $('.targetBody').append('<tr class="help"></tr>');
          $('.targetBody').append('<tr class="total"></tr>');

          $('.respon').append('<td>Respon</td>');
          $('.help').append('<td></td>');
          $('.total').append('<td>Total</td>');

          $('.respon').append(tbodyRespon);
          $('.help').append('<td colspan="' + result.brandName.length + '"></td>');
          $('.total').append(tbodyTotal);

        } else if (result.kategori == 2) {

          $('.targetHeader').html('');
          $('.targetBody').html('');

          $('.targetHeader').append('<th>Kategori</th>');
          $('.targetHeader').append(theadRespon);

          $('.targetBody').append('<tr class="noRespon"></tr>');
          $('.targetBody').append('<tr class="help"></tr>');
          $('.targetBody').append('<tr class="total"></tr>');

          $('.noRespon').append('<td>No Respon</td>');
          $('.help').append('<td></td>');
          $('.total').append('<td>Total</td>');

          $('.noRespon').append(tbodyNoRespon);
          $('.help').append('<td colspan="' + result.brandName.length + '"></td>');
          $('.total').append(tbodyTotal);

        } else if (result.kategori == 1) {

          $('.targetHeader').html('');
          $('.targetBody').html('');

          $('.targetHeader').append('<th>Kategori</th>');
          $('.targetHeader').append(theadRespon);

          $('.targetBody').append('<tr class="anak"></tr>');
          $('.targetBody').append('<tr class="help"></tr>');
          $('.targetBody').append('<tr class="total"></tr>');

          $('.anak').append('<td>Anak - anak</td>');
          $('.help').append('<td></td>');
          $('.total').append('<td>Total</td>');

          $('.anak').append(tbodyAnak);
          $('.help').append('<td colspan="' + result.brandName.length + '"></td>');
          $('.total').append(tbodyTotal);

        }


        setTimeout(function() {
          $('.kategori').val('');
        }, 200);

      }
    })
  }

  function detailBrand(dbName, idBrand, tanggalAwal, tanggalAkhir, kategori, value) {

    if (value == '-') {

      swal('Tidak ditemukan', 'Data tidak ditemukan di database', 'warning', {
        buttons: false,
        timer: 1500
      })

    } else {

      $.ajax({
        type: 'post',
        data: {
          idBrand: idBrand,
          tanggalAwal: tanggalAwal,
          tanggalAkhir: tanggalAkhir,
          kategori: kategori,
          value: value,
          dbName: dbName
        },
        url: '<?= base_url('Rekap/detailBrand'); ?>',
        dataType: 'json',
        beforeSend: function() {
          $('.rekapRow').css({
            "display": 'none'
          });
          var x = '<div class="text-center">' +
            '<span>Loading ....</span> <br>' +
            '<div class="spinner-grow text-info m-1" role="status">' +
            '<span class="visually-hidden">Loading...</span>' +
            '</div>' +
            '<div class="spinner-grow text-warning m-1" role="status">' +
            '<span class="visually-hidden">Loading...</span>' +
            '</div>' +
            '<div class="spinner-grow text-danger m-1" role="status">' +
            '<span class="visually-hidden">Loading...</span>' +
            '</div>' +
            '<div class="spinner-grow text-success m-1" role="status">' +
            '<span class="visually-hidden">Loading...</span>' +
            '</div>' +
            '</div>';
          $('.targetLoaderKesimpulan').html(x);
          $('.modalDetailVisitor').modal('show');

        },
        success: function(result) {
          console.log(result);
          $('.targetLoaderKesimpulan').html('');
          $('.rekapRow').css({
            "display": 'block'
          });

          var tr = '';
          for (var i = 0; i < result.nama.length; i++) {

            if (result.prospek[i] == 0) {

              var star = '-';

            } else {

              var star = '';
              for (var x = 0; x < result.prospek[i]; x++) {

                star += '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="30" fill="gold" class="bi bi-star-fill" viewBox="0 0 16 16">' +
                  '<path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />' +
                  '</svg>';

              }

            }

            tr += '<tr>' +
              '<td>' + result.tanggalInput[i] + '</td>' +
              '<td>' + result.nama[i] + '</td>' +
              '<td>' + result.hp[i] + '</td>' +
              '<td>' + result.kategoriName[i] + '</td>' +
              '<td>' + star + '</td>' +
              '<td>' + result.alasan[i] + '</td>' +
              '<td>' + result.sumber[i] + '</td>' +
              '<td><a href="tel:' + result.hp[i] + '"><i class="fas fa-phone"></i></a></td>' +
              '</tr>';

          }

          $('.targetDetailRespon').html(tr);

          $('.modalDetailVisitor').modal('show');

          $('.targetTitle').html('Detail rekap pada tanggal ' + result.tanggal);


          //fill table rekap
          var bodyRes = '';
          var bodyNo = '';
          for (var y = 0; y < result.params.length; y++) {

            if (result.paramsKategori == 0) {

              var thead = '<th>Tanggal</th>' +
                '<th>Respon</th>' +
                '<th>No Respon</th>' +
                '<th>Anak - anak</th>';
              $('.rekapThead').html(thead);

              bodyRes += '<tr>' +
                '<td>' + result.params[y] + '</td>' +
                '<td>' + result.paramsRespon[y] + '</td>' +
                '<td>' + result.paramsNorespon[y] + '</td>' +
                '<td>' + result.paramsAnak[y] + '</td>' +
                '</tr>';

            } else if (result.paramsKategori == 3) {

              //respon
              var thead = '<th>Tanggal</th>' +
                '<th>Respon</th>';
              $('.rekapThead').html(thead);

              bodyRes += '<tr>' +
                '<td>' + result.params[y] + '</td>' +
                '<td>' + result.paramsRespon[y] + '</td>' +
                '</tr>';

            } else if (result.paramsKategori == 2) {

              //no respon
              var thead = '<th>Tanggal</th>' +
                '<th>No Respon</th>';
              $('.rekapThead').html(thead);

              bodyRes += '<tr>' +
                '<td>' + result.params[y] + '</td>' +
                '<td>' + result.paramsNorespon[y] + '</td>' +
                '</tr>';

            } else {

              //anak anak
              var thead = '<th>Tanggal</th>' +
                '<th>Anak - anak</th>';
              $('.rekapThead').html(thead);

              bodyRes += '<tr>' +
                '<td>' + result.params[y] + '</td>' +
                '<td>' + result.paramsAnak[y] + '</td>' +
                '</tr>';

            }

            $('.rekapTbody').html(bodyRes);


            // detail sumber 
            var trSumber = '<td style="font-size: 0.8em;">' + result.ig + '</td>' +
              '<td style="font-size: 0.8em;">' + result.fb + '</td>' +
              '<td style="font-size: 0.8em;">' + result.ayo + '</td>' +
              '<td style="font-size: 0.8em;">' + result.dun + '</td>' +
              '<td style="font-size: 0.8em;">' + result.war + '</td>' +
              '<td style="font-size: 0.8em;">' + result.web + '</td>' +
              '<td style="font-size: 0.8em;">' + result.dir + '</td>';

            $('.rekapSumber').html(trSumber);

          }

        }

      })

    }

  }
</script>