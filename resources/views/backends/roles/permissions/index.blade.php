@extends('backends.layouts.master')

@section('title')
    Role Permission
@endsection

@section('content')
    <div class="card">
        <div class="card-header text-primary">
            <h2><i class="bi bi-person-check"></i> {{__('Role Permission')}}</h2>
        </div>
        <div class="card-header">
            <a href="{{route('admin.role')}}" class="btn btn-danger "><i class="bi bi-reply"></i> {{__('Back')}}</a>

        </div>
        <div class="card-body">
            <table class="table table-sm table-bordered table-hover text-center">
                <thead>
                    <tr>
                        <th>{{__('Permission')}}</th>
                        <th>{{__('View')}}</th>
                        <th>{{__('Create')}}</th>
                        <th>{{__('Edit')}}</th>
                        <th>{{__('Delete')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($role_permissions as $role_permission)
                        <tr>
                            <td>{{ $role_permission->name }}</td>
                            <td>
                                <input onclick="handlePermission('list', {{$role_permission->role_permission_id}}, {{$role_permission->list}}, {{$role_permission->id}})"
                                    type="checkbox"  value="{{ $role_permission->list}}" {{ $role_permission ->list == 1 ? 'checked' : ''}} >
                            </td>
                            <td>
                                <input onclick="handlePermission('store', {{$role_permission->role_permission_id}}, {{$role_permission->store}}, {{$role_permission->id}})" 
                                type="checkbox"  value="{{ $role_permission->store}}" {{ $role_permission ->store == 1 ? 'checked' : ''}} >
                            </td>
                            <td>
                                <input onclick="handlePermission('edit', {{$role_permission->role_permission_id}}, {{$role_permission->edit}}, {{$role_permission->id}})"
                                type="checkbox"  value="{{ $role_permission->edit}}" {{ $role_permission ->edit == 1 ? 'checked' : ''}} >
                            </td>
                            <td>
                                <input onclick="handlePermission('remove', {{$role_permission->role_permission_id}}, {{$role_permission->remove}}, {{$role_permission->id}})"
                                type="checkbox"  value="{{ $role_permission->remove}}" {{ $role_permission ->remove == 1 ? 'checked' : ''}} >
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>

@endsection
@push('js')
<script>
    function handlePermission(permission, role_permission_id, role_permission_value, permission_id) {
        let url = "{{ route('admin.role.permission.update', $role_id) }}";
        role_permission_value = role_permission_value == 0 ? 1 : 0;

        url += "?permission=" + permission +
               "&role_permission_id=" + role_permission_id +
               "&role_permission_value=" + role_permission_value +
               "&permission_id=" + permission_id;

        window.location.href = url;
    }
</script>

    
@endpush


