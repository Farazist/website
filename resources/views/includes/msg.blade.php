<div>
    @if(count($errors) > 0)
        <div class="row">
            <div class="list-group-item-danger col-6 offset-2 msg mt-5">
                <ul class="list-group-item-danger msg">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
</div>
