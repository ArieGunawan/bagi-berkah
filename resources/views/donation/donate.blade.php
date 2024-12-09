@extends('layouts.main')

@section('container')

        {{-- form --}}
        <div class="container mx-auto my-32">
            <form action="#" id="donation_form" method="POST"
            class="px-8 pt-6 pb-8 mb-4 bg-white rounded shadow-md">
              <legend class="mb-4 text-2xl font-bold">Donation</legend>
                <div class="mb-4">
                    <label for="">Nama</label>
                    <input type="text" name="donatur_name" class="block w-full mt-1 border-gray-700 rounded shadow appearance-none border-1 focus:outline-none focus:shadow-outline" id="donatur_name" autocomplete="off" required>
                </div>
              <div class="mb-4">
                <label for="" class="block mb-2 font-bold text-gray-700">Jenis Donasi</label>
                <select name="donation_type" class="block w-full mt-1 border-gray-700 rounded shadow appearance-none border-1 focus:outline-none focus:shadow-outline" id="donation_type" required>
                  <option value="medis_kesehatan">Medis & Kesehatan</option>
                  <option value="kemanusiaan">Kemanusiaan</option>
                  <option value="bencana_alam">Bencana Alam</option>
                  <option value="rumah_ibadah">Rumah Ibadah</option>
                  <option value="beasiswa_pendidikan">Beasiswa & Pendidikan</option>
                  <option value="sarana_infrastruktur">Sarana & Infrastruktur</option>
                </select>
              </div>
                <div class="mb-4">
                    <label for="">Jumlah</label>
                    <input type="text" name="amount" class="block w-full mt-1 border-gray-700 rounded shadow appearance-none border-1 focus:outline-none focus:shadow-outline" id="amount" autocomplete="off" required>
                </div>
                <div class="mb-4">
                    <label for="">Catatan (Opsional)</label>
                    <textarea name="note" class="block w-full mt-1 border-gray-700 rounded shadow appearance-none border-1 focus:outline-none focus:shadow-outline" id="note"></textarea>
                </div>

              <button class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700 focus:outline-none focus:shadow-outline" type="submit">Kirim</button>
            </form>
        </div>

        {{-- Script --}}
        <script src="https://code.jquery.com/jquery-3.4.1.min.js">
        </script>
        <script type="text/javascript"
        src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('services.midtrans.clientKey') }}">
        </script>

        <script>
            $("#donation_form").submit(function(event) {
                event.preventDefault();
                $.post("/api/donation", {
                    _method: 'POST',
                    _token: '{{ csrf_token() }}',
                    donatur_name: $('input#donatur_name').val(),
                    donation_type: $('select#donation_type').val(),
                    amount: $('input#amount').val(),
                    note: $('textarea#note').val(),
                },
                function (data, status){
                    snap.pay(data.snap_token, {
                        onSuccess: function (result) {
                            // console.log(JSON.stringify(result, null, 2));
                            // location.replace('/donation');
                            location.reload();
                        },
                        onPending: function (result) {
                            // console.log(JSON.stringify(result, null, 2));
                            // location.replace('/donation');
                            location.reload();
                        },
                        onError: function (result) {
                            // console.log(JSON.stringify(result, null, 2));
                            // location.replace('/donation');
                            location.reload();
                        }
                    });
                    return false;
                });
            })
        </script>

@endsection
