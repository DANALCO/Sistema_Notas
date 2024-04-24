#include <iostream>
#include <vector>

using namespace std;

const int MAX_NODOS = 6;

// Matriz de adyacencia que representa las conexiones entre los nodos del grafo
int grafo[MAX_NODOS][MAX_NODOS] = {
    {0, 1, 0, 0, 1, 0},
    {1, 0, 1, 0, 1, 0},
    {0, 1, 0, 1, 0, 0},
    {0, 0, 1, 0, 1, 1},
    {1, 1, 0, 1, 0, 0},
    {0, 0, 0, 1, 0, 0}
};

int num_nodos = 6;

// Función recursiva para encontrar todas las trayectorias desde nodo_actual hasta nodo_objetivo
void encontrar_trayectorias(int nodo_actual, int nodo_objetivo, vector<bool>& visitados, vector<int>& trayectoria) {
    visitados[nodo_actual] = true;
    trayectoria.push_back(nodo_actual);

    if (nodo_actual == nodo_objetivo) {
        // Imprimir la trayectoria cuando se alcanza el nodo objetivo
        for (size_t index = 0; index < trayectoria.size(); index++) {
            int nodo = trayectoria[index];
            cout << nodo+1 << " ";  // Sumar 1 para mostrar los nodos desde 1 en lugar de 0
        }
        cout << endl;
    } else {
        // Explorar nodos vecinos no visitados
        for (int i = 0; i < num_nodos; i++) {
            if (grafo[nodo_actual][i] && !visitados[i]) {
                encontrar_trayectorias(i, nodo_objetivo, visitados, trayectoria);
            }
        }
    }

    // Desmarcar el nodo_actual y eliminarlo de la trayectoria para retroceder en la búsqueda
    visitados[nodo_actual] = false;
    trayectoria.pop_back();
}

int main() {
    vector<bool> visitados(MAX_NODOS, false);
    vector<int> trayectoria;

    cout << "Todas las trayectorias desde el nodo 1 al nodo 5:" << endl;
    encontrar_trayectorias(0, 4, visitados, trayectoria);  // Llamar a la función con nodo inicial y objetivo

    return 0;
}

