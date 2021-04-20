<table>
    <tbody>
    <tr>
        <th>Kişi / Kurum Adı (*)</th>
        <th>Adresi (*)</th>
        <th>İl</th>
        <th>İlçe</th>
        <th>Telefon Ev/İş</th>
        <th>Telefon Cep</th>
        <th>E-Mail Adresi</th>
        <th>Vergi No</th>
        <th>Kargo Türü (*)</th>
        <th>Ödeme Tipi (*)</th>
        <th>İrsaliye Numarası</th>
        <th>Referans Numarası</th>
        <th>Adet (*)</th>
        <th>Kargo İçeriği</th>
        <th>Tahsilat Tipi</th>
        <th>Fatura Numarası</th>
        <th>Fatura Tutarı</th>
        <th>Dosya/Poşet No</th>
        <th>Kampanya No</th>
        <th>Kampanya Kodu</th>
    </tr>
    @foreach($cargos as $cargo)
        <tr>
            <th>{{ $cargo->receiver_name }} {{ $cargo->receiver_surname }}</th>
            <th>{{ $cargo->address }}</th>
            <th>{{ $cargo->cityname }}</th>
            <th>{{ $cargo->districtname }}</th>
            <th></th>
            <th>{{ $cargo->receiver_phone }}</th>
            <th>{{ $cargo->email }}</th>
            <th></th>
            <th>2</th>
            <th>0</th>
            <th></th>
            <th></th>
            <th>1</th>
            <th>Gıda</th>
            <th>
                @if($cargo->ref_paymentmethod == 3)
                    N
                    @endif
            </th>
            <th>{{ $cargo->orderno }}
            </th>
            <th>
                @if($cargo->ref_paymentmethod == 3)
                    {{ $cargo->totalprice }}
                @endif
            </th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
    @endforeach
    </tbody>
</table>
