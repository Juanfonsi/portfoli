package UF4;

import java.util.Scanner;

public class Prueba {
    static Scanner teclado = new Scanner(System.in);
    public static final String ANSI_RED = "\u001B[31m";
    public static final String ANSI_YELLOW = "\u001B[33m";
    public static final String ANSI_BLUE = "\u001B[34m";
    public static final String ANSI_CYAN = "\u001B[36m";
    public static final String ANSI_RESET = "\u001B[0m";
    public static final int TABLERO = 3;

    public static void main(String[] args) {
        int continuar;
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

            int posicion;
            do {
                System.out.print("Ingresa la posición (0-" + (TABLERO * TABLERO - 1) + "): ");
                posicion = teclado.nextInt();
            } while (!esPosicionValida(posicion, tablero));

            int fila = posicion / TABLERO;
            int columna = posicion % TABLERO;

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

    public static boolean esPosicionValida(int posicion, char[][] tablero) {
        if (posicion < 0 || posicion >= TABLERO * TABLERO) {
            System.out.println("Posición fuera de rango. Intente de nuevo.");
            return false;
        } else {
            int fila = posicion / TABLERO;
            int columna = posicion % TABLERO;
            if (tablero[fila][columna] != '-') {
                System.out.println("Esa casilla ya está ocupada. Intente de nuevo.");
                return false;
            } else {
                return true;
            }
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
}

