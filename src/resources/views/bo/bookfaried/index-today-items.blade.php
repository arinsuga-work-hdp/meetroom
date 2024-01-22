
<style>
    .progress-container {
        display:flex;
        align-item:center;
    }

    .progress {
        height:15px;
        width:0.17%;
    }

    .progress-run {
        background-color:blue;        
    }

    .progress-start {
        background-color:white;       
        opacity:0;
    }

    .time-title {
        width: 8%;
        text-align: center;
    }

</style>

<table id="filter" style="width: 100%;" class="table table-hover-pointer table-head-fixed text-nowrap">
    <thead>
        <tr>
            <th style="width: 1%;">No</th>
            <th style="width: 5%;">Nama</th>
            <th style="width: 5%;">Subject</th>
            <th style="width: 3%;">Tanggal</th>
            <th style="width: 3%;">Mulai</th>
            <th style="width: 3%;">Selesai</th>
            <th class="time-title"></th>
            <th class="time-title"></th>
            <th class="time-title"></th>
            <th class="time-title"></th>
            <th class="time-title"></th>
            <th class="time-title"></th>
            <th class="time-title"></th>
            <th class="time-title"></th>
            <th class="time-title"></th>
            <th class="time-title"></th>
        </tr>
    </thead>
    <tbody>

        @foreach ($viewModel->data as $key => $item)
            <tr onclick="window.location.assign('{{ route('bookfaried.show', ['bookfaried' => $item->id]) }}');">
                <td>{{ $key+1 }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->subject }}</td>

                <td>
                    <div class="text-center">{{ \Arins\Facades\Formater::date($item->meetingdt) }}</div>
                </td>
                <td>
                    <div class="text-center">{{ \Arins\Facades\Formater::time($item->startdt) }}</div>
                </td>
                <td>
                    <div class="text-center">{{ \Arins\Facades\Formater::time($item->enddt) }}</div>
                </td>

                <td colspan="10">

                    <div class="progress-container">
                        @for ($i=0; $i<=$item->progressStart; $i++)
                        <div class="progress progress-start"></div>
                        @endfor

                        @for ($i=0; $i<=$item->progressRun; $i++)
                        <div class="progress progress-run"></div>
                        @endfor

                    </div>

                </td>
            </tr>
        @endforeach

    </tbody>
</table>
