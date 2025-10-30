@extends('layouts.app')

@section('title', 'Edit Entry')

@section('content')
    <h2>Edit finance entry</h2>

    @if ($errors->any())
        <div class="errors">
            <ul>
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('finances.update', $entry->id) }}">
        @csrf
        @method('PUT')
        <div class="field">
            <label>Date</label>
            <input type="date" name="date" max="{{ now()->toDateString() }}"
                value="{{ old('date', $entry->date->toDateString()) }}" required>
        </div>
        <div class="field">
            <label>Description</label>
            <input type="text" name="description" value="{{ old('description', $entry->description) }}" required>
        </div>
        <div class="field">
            <label>Income</label>
            <input type="text" name="income" value="{{ old('income', $entry->income) }}">
        </div>
        <div class="field">
            <label>Expense</label>
            <input type="text" name="expense" value="{{ old('expense', $entry->expense) }}">
        </div>
        <div style="margin-top:10px">
            <button type="submit">Save changes</button>
            <a href="{{ route('finances.index') }}" style="margin-left:12px;color:#6b7280">Cancel</a>
        </div>
    </form>

@endsection
