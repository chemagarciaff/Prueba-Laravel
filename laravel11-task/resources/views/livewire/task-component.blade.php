<div>
    <!-- {{-- Stop trying to control. --}} -->
    <h1>Esto es un componente de Wire</h1>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Titles</th>
                <th>Descriptions</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach (Auth::user()->task as $task)
            <tr>
                <td>{{$task->title}}</td>
                <td>{{$task->description}}</td>
                <td>
                    <a href="{{route('dashboard.nuevo')}}" class="btn btn-primary">Editar</a>
                    <form action="#" method="POST">
                        @method('DELETE')
                        @csfr
                        @if ($task->id)
                        <input type="hidden" name="id" value="{{ $task->id }}">
                        @endif
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>

    </table>
</div>