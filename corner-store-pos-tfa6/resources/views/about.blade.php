@extends('layouts.app')

@section('title', 'About')

@section('content')
    <section class="page-heading">
        <p class="eyebrow">A little background</p>
        <h1>About Corner Store POS</h1>
        <p class="lead">A small project built around a store's everyday account records.</p>
    </section>

    <div class="about-grid">
        <article class="about-copy">
            <h2>Starting with the basics</h2>
            <p>Corner Store POS is a point of sale foundation project for IT0049, Technical Formative Assessment 6. It builds on the four-page TFA5 application by saving customer and user records in a database.</p>
            <p>The customer list contains full names, email addresses, and phone numbers. The user list shows the store team's full names and unique usernames.</p>
            <p>This version contains sample records for demonstration. Sales, inventory, sign-in, and account editing can be added in a future version.</p>
            <a class="button" href="{{ route('customers.index') }}">Browse the customer list <span aria-hidden="true">&rarr;</span></a>
        </article>
        <aside class="project-details" aria-labelledby="project-heading">
            <h2 id="project-heading">Project details</h2>
            <dl>
                <div><dt>Course</dt><dd>IT0049 &mdash; Web System Technologies</dd></div>
                <div><dt>Activity</dt><dd>TFA6 &mdash; From Arrays to Eloquent</dd></div>
                <div><dt>Pages</dt><dd>Home, About, Customer Accounts, User Accounts</dd></div>
                <div><dt>Purpose</dt><dd>A starting point for a store account directory</dd></div>
            </dl>
        </aside>
    </div>
@endsection
