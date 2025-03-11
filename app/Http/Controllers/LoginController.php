public function login(Request $request)
{
    $credentials = $request->validate([
        'username' => 'nullable|string',
        'email' => 'nullable|email',
        'password' => 'required|min:6'
    ]);

    // Default user data (since no database yet)
    $defaultUser = [
        'username' => 'kienhaw',
        'email' => 'kienhaw@gmail.com',
        'password' => 'Kienhaw123!'
    ];

    // Check if the user entered a username or an email
    if (
        ($credentials['username'] ?? null) === $defaultUser['username'] ||
        ($credentials['email'] ?? null) === $defaultUser['email']
    ) {
        if ($credentials['password'] === $defaultUser['password']) {
            session(['user' => (object) $defaultUser]); // Store user session
            return redirect('/'); // Redirect to homepage
        }
    }

    return back()->withErrors(['login' => 'Invalid credentials. Please try again.']);
}
