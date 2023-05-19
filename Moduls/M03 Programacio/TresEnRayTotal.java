package UF4;
import java.util.List;
import java.util.ArrayList;
import java.util.Scanner;
import java.io.*;

public class TresEnRayTotal {
    static Scanner teclado = new Scanner(System.in);
    public static final String ANSI_RED = "\u001B[31m";
    public static final String ANSI_YELLOW = "\u001B[33m";
    public static final String ANSI_BLUE = "\u001B[34m";
    public static final String ANSI_CYAN = "\u001B[36m";
    public static final String ANSI_RESET = "\u001B[0m";
    public static final int TABLERO = 3;

    private static List<Jugador> jugadores = new ArrayList<>();


    public static void main(String[] args) {
        int continuar = 0;
        System.out.println(ANSI_CYAN + "L'objectiu d'aquest joc,\nés aconseguir posar tres fitxes en línia horitzontal, vertical o diagonal abans que l'adversari ho faci." + ANSI_RESET);
        System.out.println(ANSI_CYAN + "Bona sort, i que la força t'acompanyi!!" + ANSI_RESET);

        do {
            System.out.println(ANSI_YELLOW + "\nSi vols començar una partida tecleja 1, sino vols crear una partida tecleja 0 i sortiras del joc." + ANSI_RESET);
            continuar = teclado.nextInt();

            if (continuar == 1) {
                jugarPartida();
            } else if (continuar != 0) {
                System.out.println("No has posat ni 0 ni 1");
            }
        } while (continuar != 0);
    }

    public static void jugarPartida() {
        char jugadorActual = 'X';
        char[][] tablero = crearTablero();

        while (!hayGanador(tablero) && !hayEmpate(tablero)) {
            mostrarTablero(tablero);
            System.out.println(jugadorActual == 'O' ? ANSI_RED : ANSI_BLUE + "Et toca jugador " + jugadorActual + ANSI_RESET);

            int fila, columna;
            do {
                System.out.print("ingrese la fila (0-" + (TABLERO - 1) + "): ");
                fila = teclado.nextInt();
                System.out.print("ingrese la columna (0-" + (TABLERO - 1) + "): ");
                columna = teclado.nextInt();
            } while (!esPosicionValida(fila, columna, tablero));

            tablero[fila][columna] = jugadorActual;
            jugadorActual = cambiarJugador(jugadorActual);
        }

        mostrarTablero(tablero);

        if (hayGanador(tablero)) {
            jugadorActual = cambiarJugador(jugadorActual);
            System.out.println("¡Felicitaciones jugador " + jugadorActual + ", ganaste!");
        } else {
            System.out.println("¡Empate!");
        }
    }

    public static char[][] crearTablero() {
        char[][] tablero = new char[TABLERO][TABLERO];
        for (int i = 0; i < TABLERO; i++) {
            for (int j = 0; j < TABLERO; j++) {
                tablero[i][j] = '-';
            }
        }
        return tablero;
    }

    public static void mostrarTablero(char[][] tablero) {
        System.out.println("-------------");
        for (int i = 0; i < TABLERO; i++) {
            System.out.print("| ");
            for (int j = 0; j < TABLERO; j++) {
                System.out.print(tablero[i][j] + " | ");
            }
            System.out.println();
            System.out.println("-------------");
        }
    }

    public static boolean esPosicionValida(int fila, int columna, char[][] tablero) {
        if (fila < 0 || fila >= TABLERO || columna < 0 || columna >= TABLERO) {
            System.out.println("Fila o columna fuera de rango. Intente de nuevo.");
            return false;
        } else if (tablero[fila][columna] != '-') {
            System.out.println("Esa casilla ya está ocupada. Intente de nuevo.");
            return false;
        } else {
            return true;
        }
    }

    public static char cambiarJugador(char jugadorActual) {
        return jugadorActual == 'X' ? 'O' : 'X';
    }

    public static boolean hayGanador(char[][] tablero) {
        return hayGanadorFilas(tablero) ||
                hayGanadorColumnas(tablero) ||
                hayGanadorDiagonales(tablero);
    }

    public static boolean hayGanadorFilas(char[][] tablero) {
        for (int i = 0; i < TABLERO; i++) {
            if (tablero[i][0] != '-' && tablero[i][0] == tablero[i][1] && tablero[i][1] == tablero[i][2]) {
                return true;
            }
        }
        return false;
    }

    public static boolean hayGanadorColumnas(char[][] tablero) {
        for (int j = 0; j < TABLERO; j++) {
            if (tablero[0][j] != '-' && tablero[0][j] == tablero[1][j] && tablero[1][j] == tablero[2][j]) {
                return true;
            }
        }
        return false;
    }

    public static boolean hayGanadorDiagonales(char[][] tablero) {
        if (tablero[0][0] != '-' && tablero[0][0] == tablero[1][1] && tablero[1][1] == tablero[2][2]) {
            return true;
        }
        if (tablero[0][2] != '-' && tablero[0][2] == tablero[1][1] && tablero[1][1] == tablero[2][0]) {
            return true;
        }
        return false;
    }

    public static boolean hayEmpate(char[][] tablero) {
        for (int i = 0; i < TABLERO; i++) {
            for (int j = 0; j < TABLERO; j++) {
                if (tablero[i][j] == '-') {
                    return false;
                }
            }
        }
        return true;
    }

    public static Jugador buscarJugador(String nombre) {
        for (Jugador jugador : jugadores) {
            if (jugador.getNombre().equals(nombre)) {
                return jugador;
            }
        }
        return null;
    }

    public static void jugarPartida() {
        System.out.print("Ingrese el nombre del jugador X: ");
        String nombreJugadorX = teclado.next();
        Jugador jugadorX = buscarJugador(nombreJugadorX);
        if (jugadorX == null) {
            jugadorX = new Jugador(nombreJugadorX);
            jugadores.add(jugadorX);
        }

        System.out.print("Ingrese el nombre del jugador O: ");
        String nombreJugadorO = teclado.next();
        Jugador jugadorO = buscarJugador(nombreJugadorO);
        if (jugadorO == null) {
            jugadorO = new Jugador(nombreJugadorO);
            jugadores.add(jugadorO);
        }

        char jugadorActual = 'X';
        char[][] tablero = crearTablero();

        while (!hayGanador(tablero) && !hayEmpate(tablero)) {
            // Resto del código de la partida

            // Al final de cada partida
            if (hayGanador(tablero)) {
                jugadorActual = cambiarJugador(jugadorActual);
                System.out.println("¡Felicitaciones jugador " + jugadorActual + ", ganaste!");
                if (jugadorActual == 'X') {
                    jugadorX.incrementarVictorias();
                    jugadorO.incrementarDerrotas();
                } else {
                    jugadorO.incrementarVictorias();
                    jugadorX.incrementarDerrotas();
                }
            } else {
                System.out.println("¡Empate!");
                jugadorX.incrementarEmpates();
                jugadorO.incrementarEmpates();
            }
        }


        public static void guardarRanking() {
            try {
                PrintWriter writer = new PrintWriter(new FileWriter("ranking.txt"));
                for (Jugador jugador : jugadores) {
                    writer.println("Jugador: " + jugador.getNombre());
                    writer.println("Victorias: " + jugador.getVictorias());
                    writer.println("Derrotas: " + jugador.getDerrotas());
                    writer.println("Empates: " + jugador.getEmpates());
                    writer.println("Partidas jugadas: " + jugador.getPartidasJugadas());
                    writer.println();
                }
                writer.close();
                System.out.println("Se ha guardado el ranking en el archivo 'ranking.txt'");
            } catch (IOException e) {
                System.out.println("Error al guardar el ranking en el archivo.");
            }
        }
    }



}