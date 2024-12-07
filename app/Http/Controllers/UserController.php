<?php

class UserController extends Controller
{
    public function show(Request $request)
    {
        return response()->json($request->user()); 
    }

    public function update(Request $request)
    {
        $user = $request->user(); 

        $validatedData = $request->validate([
            'name' => 'sometimes|string|max:255', 
            'email' => 'sometimes|email|unique:users,email,' . $user->id, 
        ]);

        $user->update($validatedData);

        return response()->json(['message' => 'User updated successfully.', 'user' => $user]);
    }
}
