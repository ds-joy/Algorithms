<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" 
          crossorigin="anonymous">
    <link rel="stylesheet" href="../css/home.css">
    <link rel="stylesheet" href="../Insertion_sort/insertion.css">
    <title>BFS</title>
</head>

<body>
    <!-- navigation bar -->
    <nav class="navbar navbar-expand-md navbar-dark bg-success ">
    <!-- collapse -->
        <span class="navbar-text" id="logo">
            <a class="nav-link" href="../html/home.html">Algorithms</a>
        </span>
        <button class="navbar-toggler" data-toggle="collapse" data-target="#collapse_target">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="collapse_target">
            
        <!-- navbar menus -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="../html/home.html">HOME</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../About/About.html">ABOUT</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../Referrence/referrence.html">REFERRENCES</a>
                </li>
            </ul>
        </div>
    </nav>
              
        
    <!-- middle part -->
    <div class="container-fluid">
    <div class="row">
        <div class="col-3 col-lg-2 main">
            <ul class="list-group list-group-flush">
                <li class="list-group-item"> 
                    <a href="../Insertion_sort/insertion.html">Insertion Sort</a>
                </li>
                <li class="list-group-item"> 
                    <a href="../Merge_sort/mergeSort.html">Merge Sort</a>
                </li>
                <li class="list-group-item"> 
                    <a href="../Quick_sort/quickSort.html">Quick Sort</a>
                </li>
                <li class="list-group-item"> 
                    <a href="bfs.html">Bfs</a>
                </li>
                <li class="list-group-item"> 
                        <a href="../DFS/dfs.html">Dfs</a>
                </li>
                <li class="list-group-item"> 
                    <a href="../PRIM/prims.html">Prim's Algorithm</a>
                </li>
                <li class="list-group-item"> 
                    <a href="../Kruskal/kruskal.html">Kruskal's Algorithm</a>
                </li>
                <li class="list-group-item"> 
                    <a href="../KnapsackGreedy/knapsackGreedy.html">Knapsack(Greedy)</a>
                </li>
            </ul>
        </div> <!--col-3.. main div-->
        <div class="col-9 main ">
            <h1 id="top">Breadth First Search</h1>
            <p class="content">
                    Breadth-first search is one of the simplest algorithms for searching a graph and
                    the archetype for many important graph algorithms. Prim’s minimum-spanningtree
                    algorithm  and Dijkstra’s single-source shortest-paths algorithm use ideas similar to those in breadth-first search.
               
            </p>
            

            <p class="content">
                    Given a graph G = (V,E) and a distinguished source vertex s, breadth-first
                    search systematically explores the edges of G to “discover” every vertex that is
                    reachable from s. It computes the distance (smallest number of edges) from s
                    to each reachable vertex. It also produces a “breadth-first tree” with root s that
                    contains all reachable vertices. For any vertex v reachable from s, the simple path
                    in the breadth-first tree from s to v corresponds to a “shortest path” from s to v
                    in G, that is, a path containing the smallest number of edges. The algorithm works
                    on both directed and undirected graphs.
                
            </p>
            <p class="content">
                    Breadth-first search is so named because it expands the frontier between discovered
                    and undiscovered vertices uniformly across the breadth of the frontier. That
                    is, the algorithm discovers all vertices at distance k from s before discovering any
                    vertices at distance k + 1.

            </p>
            <p class="content">
                    Breadth-first search constructs a breadth-first tree, initially containing only its
                    root, which is the source vertex s. Whenever the search discovers a white vertex v
                    in the course of scanning the adjacency list of an already discovered vertex u, the
                    vertex v and the edge (u,v) are added to the tree. We say that u is the predecessor
                    or parent of v in the breadth-first tree. Since a vertex is discovered at most once, it
                    has at most one parent. Ancestor and descendant relationships in the breadth-first
                    tree are defined relative to the root s as usual: if u is on the simple path in the tree
                    from the root s to vertex v, then u is an ancestor of v and v is a descendant of u.

            </p>
            
            <h4 class="content"> Here is an animation explaining Breadth First Search: </h4>

            <!--A gif explaining insertion sort  -->
            <div class="anim_container">
                <img src="../Pic/Animated_BFS.gif" alt="Insertion-sort01" class="img_anim">
            </div>

            <!-- pseudocode -->
            <h4 class="content"> Here is the pseudocode: </h4>
            <br>
            <div class="font-weight-bold">
            <pre>
        BFS(G,start_v):
        let Q be a queue
        label start_v as discovered
        Q.enqueue(start_v)
        while Q is not empty
            v = Q.dequeue()
            if v is the goal:
                return v
            for all edges from v to w in G.adjacentEdges(v) do
                if w is not labeled as discovered:
                    label w as discovered
                    w.parent = v
                    Q.enqueue(w)
            </pre>
            </div>

            <!-- Code -->
            <h4 class="content"> CODE:</h4>
            <div class="bg-dark content">
            <pre class="text-white">
   
    #include &#60iostream>
    #include &#60list>
        
    using namespace std;
        
    class Graph {
        int numVertices;
        list *adjLists;
        bool* visited;
    public:
        Graph(int vertices);  
        void addEdge(int src, int dest); 
        void BFS(int startVertex);
    };
        
    Graph::Graph(int vertices) {
        numVertices = vertices;
        adjLists = new list[vertices];
    }
        
    void Graph::addEdge(int src, int dest) {
        adjLists[src].push_back(dest);
        adjLists[dest].push_back(src);
    }
        
    void Graph::BFS(int startVertex) {
        visited = new bool[numVertices];
        for(int i = 0; i < numVertices; i++)
            visited[i] = false;
        
        list queue;
        
        visited[startVertex] = true;
        queue.push_back(startVertex);
        
        list::iterator i;
        
        while(!queue.empty()) {
            int currVertex = queue.front();
            cout << "Visited " << currVertex << " ";
            queue.pop_front();
        
            for(i = adjLists[currVertex].begin(); i != adjLists[currVertex].end(); ++i) {
                int adjVertex = *i;
                if(!visited[adjVertex]) {
                    visited[adjVertex] = true;
                    queue.push_back(adjVertex);
                }
            }
        }
    }
        
    int main() {
        Graph g(4);
        g.addEdge(0, 1);
        g.addEdge(0, 2);
        g.addEdge(1, 2);
        g.addEdge(2, 0);
        g.addEdge(2, 3);
        g.addEdge(3, 3);
        g.BFS(2);
        
        return 0;
    }
                            
            </pre>
        </div>

        <!-- Complexity -->
        <h4 class="content">Complexity:</h4>
        <p class="content">The Complexity of Breadth First Search is: O( V + E )</p>
        <br>
        <br>


        </div> <!-- col 9 main div  -->
    </div> <!-- row div  -->
</div> <!-- container fluid div  -->

<nav class="navbar navbar-expand-sm bg-success navbar-dark ">
       <h5 class="text-white navbar-center" >@copyright Algorithms</h5> 
 </nav>
    

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" 
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" 
            crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"     
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
            crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" 
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" 
            crossorigin="anonymous">
    </script>
</body>
</html>