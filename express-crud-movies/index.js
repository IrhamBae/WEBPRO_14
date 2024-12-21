const express = require('express');
const app = express();
const port = 3000;

app.use(express.json());

let movies = [];

app.get('/', (req, res) => {
    res.send('Welcome to the Movies API!');
});

// Create 
app.post('/movies', (req, res) => {
    const { nama, tahun_rilis, deskripsi } = req.body;
    const newMovie = {
        id: movies.length + 1,
        nama,
        tahun_rilis,
        deskripsi
    };
    movies.push(newMovie);
    res.status(201).json(newMovie);
});

// Read
app.get('/movies', (req, res) => {
    res.json(movies);
});

app.get('/movies/:id', (req, res) => {
    const movie = movies.find(m => m.id === parseInt(req.params.id));
    if (!movie) {
        return res.status(404).json({ error: "Movie not found" });
    }
    res.json(movie);
});

// Update
app.put('/movies/:id', (req, res) => {
    const { id } = req.params;
    const { nama, tahun_rilis, deskripsi } = req.body;
    const movie = movies.find(m => m.id === parseInt(id));

    if (!movie) {
        return res.status(404).json({ message: "Movie not found" });
    }

    movie.nama = nama;
    movie.tahun_rilis = tahun_rilis;
    movie.deskripsi = deskripsi;
    res.json(movie);
});

// Delete
app.delete('/movies/:id', (req, res) => {
    const { id } = req.params;
    const movieIndex = movies.findIndex(m => m.id === parseInt(id));

    if (movieIndex === -1) {
        return res.status(404).json({ message: "Movie not found" });
    }

    const [deletedMovie] = movies.splice(movieIndex, 1);
    res.json(deletedMovie);
});

// Start the server
app.listen(port, () => {
    console.log(`Server running at http://localhost:${port}`);
});
