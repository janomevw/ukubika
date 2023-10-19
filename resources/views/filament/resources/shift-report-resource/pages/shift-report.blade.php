<x-filament-panels::page>
    <div >
        <span>CRM Shift Report</span>
        <br />
        <hr class="border-gray-50 dark:border-white/5" />
        <br />

        <br />
        <hr class="border-gray-50 dark:border-white/5" />
        <br />
        <div style="--cols-default: repeat(1, minmax(0, 1fr)); --cols-sm: repeat(3, minmax(0, 1fr)); --cols-xl: repeat(3, minmax(0, 1fr));"
            class="grid grid-cols-[--cols-default] sm:grid-cols-[--cols-sm] xl:grid-cols-[--cols-xl] fi-in-component-ctn gap-6">


            <div style="--col-span-default: span 1 / span 1;" class="col-[--col-span-default]">
                <div class="fi-in-entry-wrp">
                    <div class="grid gap-y-2">
                        <div class="flex items-center justify-between gap-x-3">
                            <dt class="fi-in-entry-wrp-label inline-flex items-center gap-x-3">
                                <span class="text-sm font-medium leading-6 text-gray-950 dark:text-white">
                                    Date
                                </span>
                            </dt>
                        </div>
                        <div class="grid gap-y-2">
                            <dd class="">
                                <div class="fi-in-affixes flex fi-in-text">
                                    <div class="min-w-0 flex-1">
                                        <div class="">
                                            <div>
                                                <div class="fi-in-text-item inline-flex items-center gap-1.5 text-lg text-gray-500 dark:text-gray-400 font-bold "
                                                    style="">
                                                    <div class="">
                                                        {{ $getRecord()->report_date }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </dd>
                        </div>
                    </div>
                </div>
            </div>
            <div style="--col-span-default: span 1 / span 1;" class="col-[--col-span-default]">
                <div class="fi-in-entry-wrp">
                    <div class="grid gap-y-2">
                        <div class="flex items-center justify-between gap-x-3">
                            <dt class="fi-in-entry-wrp-label inline-flex items-center gap-x-3">
                                <span class="text-sm font-medium leading-6 text-gray-950 dark:text-white">
                                    Shift
                                </span>
                            </dt>
                        </div>
                        <div class="grid gap-y-2">
                            <dd class="">
                                <div class="fi-in-affixes flex fi-in-text">
                                    <div class="min-w-0 flex-1">
                                        <div class="">
                                            <div>
                                                <div
                                                    class="fi-in-text-item inline-flex items-center gap-1.5 text-lg text-gray-500 dark:text-gray-400 font-bold">
                                                    <div class="">
                                                        {{ Str::title($getRecord()->report_shift) }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </dd>
                        </div>
                    </div>
                </div>
            </div>
            <div style="--col-span-default: span 1 / span 1;" class="col-[--col-span-default]">
                <div class="fi-in-entry-wrp">
                    <div class="grid gap-y-2">
                        <div class="flex items-center justify-between gap-x-3">
                            <dt class="fi-in-entry-wrp-label inline-flex items-center gap-x-3">
                                <span class="text-sm font-medium leading-6 text-gray-950 dark:text-white">
                                    Foreman
                                </span>
                            </dt>
                        </div>
                        <div class="grid gap-y-2">
                            <dd class="">
                                <div class="fi-in-affixes flex fi-in-text">
                                    <div class="min-w-0 flex-1">
                                        <div class="">
                                            <div>
                                                <div
                                                    class="fi-in-text-item inline-flex items-center gap-1.5 text-lg text-gray-500 dark:text-gray-400 font-bold ">
                                                    <div class="">
                                                        {{ $getRecord()->foreman->name }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </dd>
                        </div>
                    </div>
                </div>
            </div>




            <div style="--col-span-default: span 1 / span 1;" class="col-[--col-span-default]">
                <div class="fi-in-entry-wrp">
                    <div class="grid gap-y-2">
                        <div class="flex items-center justify-between gap-x-3">
                            <span class="text-sm font-medium leading-6 text-gray-950 dark:text-white">
                                Shift Input
                            </span>
                        </div>
                        <div class="grid gap-y-2">
                            <div class="fi-in-affixes flex fi-in-text">
                                <div class="min-w-0 flex-1">
                                    <div
                                        class="fi-in-text-item inline-flex items-center gap-1.5 text-lg text-gray-500 dark:text-gray-400 font-bold">
                                        {{ $getRecord()->input_weight . ' MT' }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>





            <div style="--col-span-default: span 1 / span 1;" class="col-[--col-span-default]">
                <div class="fi-in-entry-wrp">
                    <div class="grid gap-y-2">
                        <div class="flex items-center justify-between gap-x-3">
                            <dt class="fi-in-entry-wrp-label inline-flex items-center gap-x-3">
                                <span class="text-sm font-medium leading-6 text-gray-950 dark:text-white">
                                    Shift Output
                                </span>
                            </dt>
                        </div>
                        <div class="grid gap-y-2">
                            <dd class="">
                                <div class="fi-in-affixes flex fi-in-text">
                                    <div class="min-w-0 flex-1">
                                        <div class="">
                                            <div>
                                                <div class="fi-in-text-item inline-flex items-center gap-1.5 text-lg text-gray-500 dark:text-gray-400 font-bold "
                                                    style="">
                                                    <svg class="fi-in-text-item-icon h-5 w-5 text-gray-400 dark:text-gray-500"
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                        fill="currentColor" aria-hidden="true">
                                                        <path fill-rule="evenodd"
                                                            d="M5.22 14.78a.75.75 0 001.06 0l7.22-7.22v5.69a.75.75 0 001.5 0v-7.5a.75.75 0 00-.75-.75h-7.5a.75.75 0 000 1.5h5.69l-7.22 7.22a.75.75 0 000 1.06z"
                                                            clip-rule="evenodd"></path>
                                                    </svg>
                                                    <div class="">
                                                        {{ $getRecord()->output_weight . ' MT' }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </dd>
                        </div>
                    </div>
                </div>
            </div>
            <div style="--col-span-default: span 1 / span 1;" class="col-[--col-span-default]">
                <div class="fi-in-entry-wrp">
                    <div class="grid gap-y-2">
                        <div class="flex items-center justify-between gap-x-3">
                            <dt class="fi-in-entry-wrp-label inline-flex items-center gap-x-3">
                                <span class="text-sm font-medium leading-6 text-gray-950 dark:text-white">
                                    Coil Ends
                                </span>
                            </dt>
                        </div>
                        <div class="grid gap-y-2">
                            <dd class="">
                                <div class="fi-in-affixes flex fi-in-text">
                                    <div class="min-w-0 flex-1">
                                        <div class="">
                                            <div>
                                                <div class="fi-in-text-item inline-flex items-center gap-1.5 text-lg text-gray-500 dark:text-gray-400 font-bold "
                                                    style="">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M7.5 21L3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5" />
                                                    </svg>

                                                    <div class="">
                                                        @php
                                                            $coil_ends = ($getRecord()->input_weight - $getRecord()->output_weight);
                                                        @endphp
                                                        {{ $coil_ends . ' MT' }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </dd>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr class="border-gray-50 dark:border-white/5" /><br />
        <div class="grid gap-y-2">
            <div class="filament-table-repeater-component space-y-6 relative break-point-md">
                <div
                    class="filament-table-repeater-container rounded-md relative ring-1 ring-gray-950/5 dark:ring-white/20">
                    <table class="w-full" style="table-layout: fixed!important">
                        <thead class="rounded-t-lg overflow-hidden border-b border-gray-950/5 dark:border-white/5">
                            <tr class="text-xs md:divide-x md:divide-gray-950/5 dark:md:divide-white/20">
                                <th
                                    class="px-3 py-2 font-medium text-left dark:text-gray-300  bg-gray-50 dark:bg-white/5 ltr:rounded-tl-lg rtl:rounded-tr-lg">
                                    Width
                                </th>
                                <th class="px-3 py-2 font-medium text-left dark:text-gray-300  bg-gray-50 dark:bg-white/5">
                                    Thickness
                                </th>
                                <th class="px-3 py-2 font-medium text-left dark:text-gray-300  bg-gray-50 dark:bg-white/5">
                                    Input weight
                                </th>
                                <th class="px-3 py-2 font-medium text-left dark:text-gray-300  bg-gray-50 dark:bg-white/5">
                                    Output weight
                                </th>
                                <th class="px-3 py-2 font-medium text-left dark:text-gray-300  bg-gray-50 dark:bg-white/5">
                                    Grade
                                </th>
                                <th
                                    class="font-medium text-left ltr:rounded-tr-lg rtl:rounded-tl-lg p-2 bg-gray-50 dark:bg-white/5">
                                    Order
                                </th>
                            </tr>
                        </thead>
                        <tbody class="filament-table-repeater-rows-wrapper divide-y divide-gray-950/5 dark:divide-white/20">
                            @foreach($getRecord()->shift_report_lines as $report_line)
                                <tr
                                    class="filament-table-repeater-row md:divide-x md:divide-gray-950/5 dark:md:divide-white/20">
                                    <td class="filament-table-repeater-column p-2 has-hidden-label">
                                        <div class="fi-fo-field-wrp">
                                            <label for="data.shift_report_lines.record-1.width" class="sr-only">
                                                Width
                                            </label>

                                            <div class="grid gap-y-2">

                                                <div class="grid gap-y-2 px-2">
                                                    {{ $report_line->width }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="filament-table-repeater-column p-2 has-hidden-label">
                                        <div class="fi-fo-field-wrp">
                                            <label for="data.shift_report_lines.record-1.thickness" class="sr-only">
                                                Thickness
                                            </label>
                                            <div class="grid gap-y-2">
                                                <div class="grid gap-y-2 px-2">
                                                    {{ $report_line->thickness }}
                                                </div>
                                            </div>
                                        </div>

                                    </td>
                                    <td class="filament-table-repeater-column p-2 has-hidden-label">
                                        <div class="fi-fo-field-wrp">
                                            <label for="data.shift_report_lines.record-1.input_weight" class="sr-only">
                                                Input weight
                                            </label>

                                            <div class="grid gap-y-2">

                                                <div class="grid gap-y-2 px-2">
                                                    {{ $report_line->input_weight }}
                                                </div>
                                            </div>
                                        </div>

                                    </td>
                                    <td class="filament-table-repeater-column p-2 has-hidden-label">
                                        <div class="fi-fo-field-wrp">
                                            <label for="data.shift_report_lines.record-1.output_weight" class="sr-only">
                                                Output weight
                                            </label>
                                            <div class="grid gap-y-2">

                                                <div class="grid gap-y-2 px-2">
                                                    {{ $report_line->output_weight }}
                                                </div>
                                            </div>
                                        </div>

                                    </td>
                                    <td class="filament-table-repeater-column p-2 has-hidden-label" style="width: 200px">
                                        <div class="fi-fo-field-wrp">
                                            <label for="data.shift_report_lines.record-1.grade" class="sr-only">
                                                Grade
                                            </label>

                                            <div class="grid gap-y-2">

                                                <div class="grid gap-y-2 px-2">
                                                    {{ Str::title($report_line->grade) }}
                                                </div>
                                            </div>
                                        </div>

                                    </td>
                                    <td class="filament-table-repeater-column p-2 has-hidden-label">
                                        <div class="fi-fo-field-wrp">
                                            <label for="data.shift_report_lines.record-1.production_order" class="sr-only">
                                                Order
                                            </label>

                                            <div class="grid gap-y-2">

                                                <div class="grid gap-y-2 px-2">
                                                    {{ $report_line->production_order }}
                                                </div>
                                            </div>
                                        </div>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <br />
        <hr class="border-gray-50 dark:border-white/5" /><br />
        <div class="grid gap-y-2">
            <div class="filament-table-repeater-component space-y-6 relative break-point-md">
                <div
                    class="filament-table-repeater-container rounded-md relative ring-1 ring-gray-950/5 dark:ring-white/20">
                    <table class="w-full">
                        <tbody class="filament-table-repeater-rows-wrapper divide-y divide-gray-950/5 dark:divide-white/20">
                            <tr
                                class="filament-table-repeater-row md:divide-x md:divide-gray-950/5 dark:md:divide-white/20">
                                <th class="px-3 py-2 font-medium text-xs text-left dark:text-gray-300  bg-gray-50 dark:bg-white/5 ltr:rounded-tl-lg rtl:rounded-tr-lg"
                                    style="width: 16.67%;">
                                    Safety
                                </th>
                                <td class="filament-table-repeater-column p-2 has-hidden-label">
                                    <div class="fi-fo-field-wrp">
                                        <label for="data.shift_report_lines.record-1.width" class="sr-only">
                                            Safety
                                        </label>
                                        <div class="grid gap-y-2">

                                            <div class="grid gap-y-2 px-2">
                                                {{ $getRecord()->safety }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr
                                class="filament-table-repeater-row md:divide-x md:divide-gray-950/5 dark:md:divide-white/20">
                                <th
                                    class="px-3 py-2 font-medium text-xs text-left dark:text-gray-300  bg-gray-50 dark:bg-white/5 ltr:rounded-tl-lg rtl:rounded-tr-lg">
                                    Quality
                                </th>
                                <td class="filament-table-repeater-column p-2 has-hidden-label">
                                    <div class="fi-fo-field-wrp">
                                        <label for="data.shift_report_lines.record-1.width" class="sr-only">
                                            Quality
                                        </label>
                                        <div class="grid gap-y-2">

                                            <div class="grid gap-y-2 px-2">
                                                {{ $getRecord()->quality }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr
                                class="filament-table-repeater-row md:divide-x md:divide-gray-950/5 dark:md:divide-white/20">
                                <th
                                    class="px-3 py-2 font-medium text-xs text-left dark:text-gray-300  bg-gray-50 dark:bg-white/5 ltr:rounded-tl-lg rtl:rounded-tr-lg">
                                    Other
                                </th>
                                <td class="filament-table-repeater-column p-2 has-hidden-label">
                                    <div class="fi-fo-field-wrp">
                                        <label for="data.shift_report_lines.record-1.width" class="sr-only">
                                            Other
                                        </label>
                                        <div class="grid gap-y-2">

                                            <div class="grid gap-y-2 px-2">
                                                {{ $getRecord()->other }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <hr class="border-gray-50 dark:border-white/5" /><br />
        <div class="grid gap-y-2">
            <div class="filament-table-repeater-component space-y-6 relative break-point-md">
                <div
                    class="filament-table-repeater-container rounded-md relative ring-1 ring-gray-950/5 dark:ring-white/20">
                    <table class="w-full" style="table-layout: fixed!important">
                        <thead class="rounded-t-lg overflow-hidden border-b border-gray-950/5 dark:border-white/5">
                            <tr class="text-xs md:divide-x md:divide-gray-950/5 dark:md:divide-white/20">
                                <th
                                    class="px-3 py-2 font-medium text-left dark:text-gray-300  bg-gray-50 dark:bg-white/5 ltr:rounded-tl-lg rtl:rounded-tr-lg">
                                    Department
                                </th>
                                <th class="px-3 py-2 font-medium text-left dark:text-gray-300  bg-gray-50 dark:bg-white/5">
                                    Type
                                </th>
                                <th class="px-3 py-2 font-medium text-left dark:text-gray-300  bg-gray-50 dark:bg-white/5">
                                    Delay Start
                                </th>
                                <th class="px-3 py-2 font-medium text-left dark:text-gray-300  bg-gray-50 dark:bg-white/5">
                                    Delay End
                                </th>
                                <th class="px-3 py-2 font-medium text-left dark:text-gray-300  bg-gray-50 dark:bg-white/5">
                                    Duration
                                </th>
                                <th
                                    class="font-medium text-left ltr:rounded-tr-lg rtl:rounded-tl-lg p-2 bg-gray-50 dark:bg-white/5">
                                    Reason
                                </th>
                            </tr>
                        </thead>
                        <tbody class="filament-table-repeater-rows-wrapper divide-y divide-gray-950/5 dark:divide-white/20">
                            @foreach($getRecord()->delays as $delay)
                                <tr
                                    class="filament-table-repeater-row md:divide-x md:divide-gray-950/5 dark:md:divide-white/20">
                                    <td class="filament-table-repeater-column p-2 has-hidden-label">
                                        <div class="fi-fo-field-wrp">
                                            <label for="data.shift_report_lines.record-1.width" class="sr-only">
                                                Department
                                            </label>

                                            <div class="grid gap-y-2">
                                                <div class="grid gap-y-2 px-2">
                                                    {{ $delay->department['department'] }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="filament-table-repeater-column p-2 has-hidden-label">
                                        <div class="fi-fo-field-wrp">
                                            <label for="data.shift_report_lines.record-1.thickness" class="sr-only">
                                                Type
                                            </label>
                                            <div class="grid gap-y-2">
                                                <div class="grid gap-y-2 px-2">
                                                    {{ Str::title($delay->type) }}
                                                </div>
                                            </div>
                                        </div>

                                    </td>
                                    <td class="filament-table-repeater-column p-2 has-hidden-label">
                                        <div class="fi-fo-field-wrp">
                                            <div class="grid gap-y-2">
                                                <div class="grid gap-y-2 px-2">
                                                    {{ date('G:i', strtotime($delay->delay_start)) }}
                                                </div>
                                            </div>
                                        </div>

                                    </td>
                                    <td class="filament-table-repeater-column p-2 has-hidden-label">
                                        <div class="fi-fo-field-wrp">
                                            <div class="grid gap-y-2">
                                                <div class="grid gap-y-2 px-2">
                                                    {{ date('G:i', strtotime($delay->delay_end)) }}
                                                </div>
                                            </div>
                                        </div>

                                    </td>
                                    <td class="filament-table-repeater-column p-2 has-hidden-label" style="width: 200px">
                                        <div class="fi-fo-field-wrp">
                                            <div class="grid gap-y-2">
                                                <div class="grid gap-y-2 px-2">
                                                    {{ $delay->duration . ' minutes' }}
                                                </div>
                                            </div>
                                        </div>

                                    </td>
                                    <td class="filament-table-repeater-column p-2 has-hidden-label">
                                        <div class="fi-fo-field-wrp">
                                            <div class="grid gap-y-2">
                                                <div class="grid gap-y-2 px-2">
                                                    {{ $delay->reason }}
                                                </div>
                                            </div>
                                        </div>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>



    </div>





    {{-- <div class="fi-ac gap-3 flex flex-wrap items-center justify-start fi-form-actions">
        <a style=";"
            class="fi-btn fi-btn-size-md relative grid-flow-col items-center justify-center font-semibold outline-none transition duration-75 focus:ring-2 disabled:pointer-events-none disabled:opacity-70 rounded-lg fi-btn-color-gray gap-1.5 px-3 py-2 text-sm inline-grid shadow-sm bg-white text-gray-950 hover:bg-gray-50 dark:bg-white/5 dark:text-white dark:hover:bg-white/10 ring-1 ring-gray-950/10 dark:ring-white/20 fi-ac-btn-action"
            href="{{ redirect()->back() }}">
    <span class="fi-btn-label">
        Cancel
    </span>
    </a>
    </div> --}}

</x-filament-panels::page>
