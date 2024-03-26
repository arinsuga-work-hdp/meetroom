<table id="filter" style="width: 90%;" class="table table-hover-pointer table-head-fixed">
    <thead>
        <tr>
            <th style="width: 3%;"></th>
            <th style="width: 3%;">Status</th>
            <th style="width: 3%;">Tanggal</th>
            <th style="width: 3%;">Mulai</th>
            <th style="width: 3%;">Selesai</th>
            <th style="width: 25%;">Nama Pemesan</th>
            <th style="width: 50%;">Subject</th>
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
                <td>
                    @if ($item->orderstatus_id == "4")

                        <div class="badge bg-orange">{{ $item->orderStatus->name }}</div>

                    @elseif ($item->orderstatus_id == "5")

                        <div class="badge bg-success">Done</div>

                    @else
                        {{ $item->orderStatus->name }}
                    @endif
                </td>

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
