<div class="sidebar-group">

    <!-- BEGIN: Settings -->
    <div class="sidebar" id="settings">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title d-flex justify-content-between">
                    Settings
                    <a class="btn-sidebar-close" href="#">
                        <i class="ti-close"></i>
                    </a>
                </h6>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item pl-0 pr-0">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="customSwitch1" checked>
                            <label class="custom-control-label" for="customSwitch1">Allow notifications.</label>
                        </div>
                    </li>
                    <li class="list-group-item pl-0 pr-0">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="customSwitch2">
                            <label class="custom-control-label" for="customSwitch2">Hide user requests</label>
                        </div>
                    </li>
                    <li class="list-group-item pl-0 pr-0">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="customSwitch3" checked>
                            <label class="custom-control-label" for="customSwitch3">Speed up demands</label>
                        </div>
                    </li>
                    <li class="list-group-item pl-0 pr-0">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="customSwitch4" checked>
                            <label class="custom-control-label" for="customSwitch4">Hide menus</label>
                        </div>
                    </li>
                    <li class="list-group-item pl-0 pr-0">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="customSwitch5">
                            <label class="custom-control-label" for="customSwitch5">Remember next visits</label>
                        </div>
                    </li>
                    <li class="list-group-item pl-0 pr-0">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="customSwitch6">
                            <label class="custom-control-label" for="customSwitch6">Enable report
                                generation.</label>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- END: Settings -->

    <!-- BEGIN: Chat List -->
    <div class="sidebar" id="chat-list">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title d-flex justify-content-between">
                    Chats
                    <a class="btn-sidebar-close" href="#">
                        <i class="ti-close"></i>
                    </a>
                </h6>
                <div class="list-group list-group-flush">
                    @foreach ($messages as $item)

                    @php
                        $name = $item->name;
                        $first_latter = strtoupper(substr($name, 0,1));
                        if($first_latter == "A" || $first_latter == "G" || $first_latter == "M" || $first_latter == "S" || $first_latter == "Y"){
                            $color = "primary";
                        }
                        elseif($first_latter == "B" || $first_latter == "H" || $first_latter == "N" || $first_latter == "T" || $first_latter == "Z"){
                            $color = "secondary";
                        }
                        elseif($first_latter == "C" || $first_latter == "I" || $first_latter == "O" || $first_latter == "U"){
                            $color = "success";
                        }
                        elseif($first_latter == "D" || $first_latter == "J" || $first_latter == "P" || $first_latter == "V"){
                            $color = "danger";
                        }
                        elseif($first_latter == "E" || $first_latter == "K" || $first_latter == "Q" || $first_latter == "W"){
                            $color = "warning";
                        }
                        elseif($first_latter == "F" || $first_latter == "L" || $first_latter == "R" || $first_latter == "X"){
                            $color = "info";
                        }

                    @endphp
                    <a href="{{ url('message/view') }}/{{ $item->id }}" class="list-group-item px-0 d-flex align-items-start">
                        <div class="pr-3">
                            <div class="avatar">
                                <span class="avatar-title bg-{{ $color }} rounded-circle">{{ $first_latter }}</span>
                            </div>
                        </div>
                        <div>
                            <h6 class="mb-1">{{ $item->name }}</h6>
                            <span class="{{ $item->action == 1 ? "text-dark" : "text-muted" }}">{{ $item->message }}</span>
                        </div>
                        <div class="text-right ml-auto d-flex flex-column">
                            @if ($item->created_at->diffInDays() >= 30)
                            <span class="small text-muted">
                                {{ $item->created_at->format('d M, Y') }}
                            </span>
                            @elseif ($item->created_at->diffInDays() >= 2)
                            <span class="small text-muted">
                                {{ $item->created_at->diffForHumans() }}
                            </span>
                            @else
                                <span class="bsmall text-muted">
                                    {{ $item->created_at->diffForHumans() }}
                                </span>
                            @endif
                        </div>
                    </a>
                     @endforeach


                </div>
            </div>
        </div>
    </div>
    <!-- END: Chat List -->

</div>
