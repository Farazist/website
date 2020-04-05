<div class="card shadow rounded-lg border-0 h-100 w-100 bg-white front">

    <div class="card-header border-0 bg-transparent p-2">
        @if($i3class->state != 1)
            <span class="badge badge-light float-right">{{ $i3class->code }}</span>
        @else
            <span class="badge badge-success float-right">در حال ثبت نام</span>
        @endif
    </div>

    <div class="card-img position-relative mx-auto mt-3" style="height: 100px; width: 100px;">
        <img src="{{ URL::asset($i3class->course->image) }}" class="img-fluid" alt="{{$i3class->course->name}}">
    </div>

    <div class="card-body text-center">
        <h3 class="card-title">
            {{$i3class->course->name}}
        </h3>
        <p class="card-text text-wrap small">
            {{ $i3class->course->short_explanation }}
        </p>
    </div>

    <div class="card-footer border-0 bg-transparent text-dark p-3">
        <h4 class="mb-3">
            <i class="fas fa-user fa-fw"></i>
            مدرس:
            {{ $i3class->teacher->name }}
        </h4>
        <h4 class="mb-3">
            <i class="fas fa-calendar-check fa-fw"></i>
            تاریخ شروع:
            {{ $i3class->start_date }}
        </h4>
        <h4 class="mb-0">
            <i class="fas fa-clock fa-fw"></i>
            طول دوره:
            {{$i3class->time}}
            ساعت
        </h4>
    </div>

    <div class="back text-white bg-danger rounded-lg position-absolute h-100 w-100">
        <div class="card-body">
            <h5 class="mb-3">
                <i class="fas fa-user fa-fw"></i>
                مدرس:
                <a href="{{ URL::asset("/teacher/" . str_replace(' ', '-', $i3class->teacher->name) . "/" . $i3class->teacher->id) }}"
                   class="text-decoration-none btn btn-sm btn-light text-danger">
                    {{ $i3class->teacher->name }}
                </a>
            </h5>
            @if($i3class->teacher_assistant->name != "")
                <h5 class="mb-3">
                    <i class="fas fa-user fa-fw"></i>
                    کمک مدرس:
                    <a href="{{ URL::asset("/teacher/" . str_replace(' ', '-', $i3class->teacher_assistant->name) . "/" . $i3class->teacher_assistant->id) }}"
                       class="text-decoration-none btn btn-sm btn-light text-danger">
                        {{ $i3class->teacher_assistant->name }}
                    </a>
                </h5>
            @endif
            <hr>
            <h5 class="mb-3">
                <i class="fas fa-clock fa-fw"></i>
                طول دوره:
                {{$i3class->time}}
                ساعت
            </h5>
            <h5 class="mb-3">
                <i class="fas fa-coins fa-fw"></i>
                شهریه:
                {{$i3class->price}}
                تومان
            </h5>
            <hr>
            <h5 class="mb-3">
                <i class="fas fa-calendar-check fa-fw"></i>
                تاریخ شروع:
                {{ $i3class->start_date }}
            </h5>
            <h5 class="mb-3">
                <i class="fas fa-calendar-week fa-fw"></i>
                {{$i3class->weekdays}}
            </h5>
            <h5 class="mb-3">
                <i class="fas fa-clock fa-fw"></i>
                زمان برگزاری:
                {{$i3class->start_time}}
                -
                {{$i3class->end_time}}
            </h5>

            @if($i3class->details != "")
                <h5 class="mb-3">
                    <i class="fas fa-info fa-fw"></i>
                    {{$i3class->details}}
                </h5>
            @endif
        </div>
        <a href="{{ URL::asset("/course/" . str_replace(' ', '-', $i3class->course->name)) }}"
           class="btn btn-light btn-sm text-danger position-absolute" style="left: 10px; bottom: 10px;">
            اطلاعات بیشتر
        </a>
    </div>
</div>
