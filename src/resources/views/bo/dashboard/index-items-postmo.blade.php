<table id="filter" style="width: 90%;" class="table table-hover-pointer table-head-fixed">
    <thead>
        <tr>
            <th style="width: 5%;"></th>
            <th style="width: 5%;">Status</th>
            <th style="width: 5%;">Tanggal</th>
            <th style="width: 5%;">Mulai</th>
            <th style="width: 5%;">Selesai</th>
            <th style="width: 30%;">Nama</th>
            <th style="width: 35%;">Subject</th>
        </tr>
    </thead>
    <tbody>

        @if (count($dataPostmo) == 0)
            <tr>
                <td colspan="9" class="text-center">Data Tidak</td>
            </tr>
        @endif

        @foreach ($dataPostmo as $item)
            <tr onclick="window.location.assign('{{ route('bookpostmo.show', ['bookpostmo' => $item->id]) }}');">
                <td></td>
                <td>{{ $item->orderStatus->name }}</td>
                <td>
                    <div class="text-center">{{ \Arins\Facades\Formater::date($item->meetingdt) }}</div>
                </td>
                <td>
                    <div class="text-center">{{ \Arins\Facades\Formater::time($item->startdt) }}</div>
                </td>
                <td>
                    <div class="text-center">{{ \Arins\Facades\Formater::time($item->enddt) }}</div>
                </td>
                <td>
                    <div>{{ $item->name }}</div>
                </td>
                <td>
                    <div class="truncate-multiline">{!! nl2br(e($item->subject)) !!}</div>
                </td>
            </tr>
        @endforeach

    </tbody>
</table>
