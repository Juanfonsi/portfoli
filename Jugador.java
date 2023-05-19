package UF4;

public class Jugador {
    private String nombre;
    private int victorias;
    private int derrotas;
    private int empates;
    private int partidasJugadas;

    public Jugador(String nombre) {
        this.nombre = nombre;
        this.victorias = 0;
        this.derrotas = 0;
        this.empates = 0;
        this.partidasJugadas = 0;
    }

    // Métodos getter y setter para cada propiedad

    public String getNombre() {
        return nombre;
    }

    public int getVictorias() {
        return victorias;
    }

    public int getDerrotas() {
        return derrotas;
    }

    public int getEmpates() {
        return empates;
    }

    public int getPartidasJugadas() {
        return partidasJugadas;
    }

    public void incrementarVictorias() {
        victorias++;
        partidasJugadas++;
    }

    public void incrementarDerrotas() {
        derrotas++;
        partidasJugadas++;
    }

    public void incrementarEmpates() {
        empates++;
        partidasJugadas++;
    }
}

