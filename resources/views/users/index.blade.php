@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Users</h1>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->roles->pluck('name')->implode(', ') }}</td>
                    <td>
                        <button class="btn btn-warning" data-toggle="modal" data-target="#editUserRoleModal{{ $user->id }}">Edit Role</button>
                    </td>
                </tr>

                <!-- Edit User Role Modal -->
                <div class="modal fade" id="editUserRoleModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="editUserRoleModalLabel{{ $user->id }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editUserRoleModalLabel{{ $user->id }}">Edit User Role</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('users.updateRole', $user->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <div class="form-group">
                                        <label for="roles">Roles</label>
                                        @foreach($roles as $role)
                                            <div class="form-check">
                                                <input type="checkbox" name="roles[]" value="{{ $role->id }}" class="form-check-input" {{ $user->roles->contains($role) ? 'checked' : '' }}>
                                                <label class="form-check-label">{{ $role->name }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                    <button type="submit" class="btn btn-primary">Update Role</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
