public function store(Request $request)
{
    // Validate the request data
    $request->validate([
        // Add validation rules
    ]);

    // Process the form submission
    // Save the data to the database

    // Redirect with success message
    return redirect()->back()->with('success', 'Stock added successfully.');
}
// ...existing code...
