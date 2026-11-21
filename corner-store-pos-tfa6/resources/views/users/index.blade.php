@extends('layouts.app')

@section('title', 'User Accounts')

@section('content')
    <section class="page-heading">
        <p class="eyebrow">The team behind the counter</p>
        <h1>User Accounts</h1>
        <p class="lead">A quick look at the store team's names and usernames.</p>
    </section>

    <section class="table-panel" aria-labelledby="user-list-heading">
        <div class="table-heading">
            <h2 id="user-list-heading">User directory</h2>
            <span class="record-count">{{ $users->count() }} records</span>
        </div>
        <div class="table-scroll" tabindex="0" role="region" aria-label="User directory table, scroll horizontally on small screens">
            <table>
                <caption class="sr-only">Store user accounts and usernames</caption>
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Full name</th>
                        <th scope="col">Username</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td class="account-id">U{{ str_pad($user->id, 3, '0', STR_PAD_LEFT) }}</td>
                            <th scope="row">{{ $user->full_name }}</th>
                            <td>{{ $user->username }}</td>
                        </tr>
                    @endforeach

                    @if ($users->isEmpty())
                        <tr><td colspan="3">No user accounts found.</td></tr>
                    @endif
                </tbody>
            </table>
        </div>
        <p class="table-note">User accounts saved in the store directory.</p>
    </section>
@endsection
