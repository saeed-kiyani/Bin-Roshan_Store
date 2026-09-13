public function run(): void
{
    $this->call([
        CategorySeeder::class,
        ProductSeeder::class,
    ]);
}