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
    <title>Kruskal's Algorithm</title>
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
                    <a href="../BFS/bfs.html">Bfs</a>
                </li>
                <li class="list-group-item"> 
                        <a href="../DFS/dfs.html">Dfs</a>
                </li>
                <li class="list-group-item"> 
                    <a href="../PRIM/prims.html">Prim's Algorithm</a>
                </li>
                <li class="list-group-item"> 
                    <a href="kruskal.html">Kruskal's Algorithm</a>
                </li>
                <li class="list-group-item"> 
                        <a href="../KnapsackBruteForce/KnapsackBrute.html">Knapsack Brute Force</a>
                    </li>
                <li class="list-group-item"> 
                    <a href="../KnapsackGreedy/knapsackGreedy.html">Knapsack(Greedy)</a>
                </li>
            </ul>
        </div> <!--col-3.. main div-->
        <div class="col-9 main ">
            <h1 id="top">Kruskal's Algorithm</h1>
            <p class="content">
                    Kruskal’s algorithm finds a safe edge to add to the growing forest by finding, of all
                    the edges that connect any two trees in the forest, an edge (u,v) of least weight.
                    Let C1 and C2 denote the two trees that are connected by (u,v). Since (u,v) must
                    be a light edge connecting C1 to some other tree, (u,v) is a safe edge for C1. Kruskal’s algorithm qualifies as a greedy algorithm because at each step it adds to the forest an edge of least possible weight.
                 
            </p>

            <p class="content">
                    Our implementation of Kruskal’s algorithm is like the algorithm to compute
                    connected components from Section 21.1. It uses a disjoint-set data structure to
                    maintain several disjoint sets of elements. Each set contains the vertices in one tree
                    of the current forest. The operation FIND-SET(u) returns a representative element
                    from the set that contains u. Thus, we can determine whether two vertices u and v
                    belong to the same tree by testing whether FIND-SET(u) equals FIND-SET(v) To
                    combine trees, Kruskal’s algorithm calls the UNION procedure.
            </p>
           
            
            <h4 class="content"> Here is an animation explaining Kruskal's Algorithm: </h4>

            <!--A gif explaining insertion sort  -->
            <div class="anim_container">
                <img src="../Pic/KruskalDemo.gif" alt="Kruskal" class="img_anim">
            </div>

            <!-- pseudocode -->
            <h4 class="content"> Here is the pseudocode: </h4>
            <br>
            <div class="font-weight-bold">
            <pre>
                KRUSKAL(G):
                A = ∅
                foreach v ∈ G.V:
                    MAKE-SET(v)
                foreach (u, v) in G.E ordered by weight(u, v), increasing:
                    if FIND-SET(u) ≠ FIND-SET(v):
                        A = A ∪ {(u, v)}
                        UNION(FIND-SET(u), FIND-SET(v))
                return A
            </pre>
            </div>

            <!-- Code -->
            <h4 class="content"> CODE:</h4>
            <div class="bg-dark content">
            <pre class="text-white">
   
    // C++ program for Kruskal's algorithm to find Minimum Spanning Tree  
    // of a given connected, undirected and weighted graph  
    #include &#60bits/stdc++.h> 
    using namespace std; 
        
    // a structure to represent a weighted edge in graph  
    class Edge  
    {  
        public: 
        int src, dest, weight;  
    };  
        
    // a structure to represent a connected, undirected  
    // and weighted graph  
    class Graph  
    {  
        public: 
        // V-> Number of vertices, E-> Number of edges  
        int V, E;  
        
        // graph is represented as an array of edges.  
        // Since the graph is undirected, the edge  
        // from src to dest is also edge from dest  
        // to src. Both are counted as 1 edge here.  
        Edge* edge;  
    };  
        
    // Creates a graph with V vertices and E edges  
    Graph* createGraph(int V, int E)  
    {  
        Graph* graph = new Graph;  
        graph->V = V;  
        graph->E = E;  
        
        graph->edge = new Edge[E];  
        
        return graph;  
    }  
        
    // A structure to represent a subset for union-find  
    class subset  
    {  
        public: 
        int parent;  
        int rank;  
    };  
        
    // A utility function to find set of an element i  
    // (uses path compression technique)  
    int find(subset subsets[], int i)  
    {  
        // find root and make root as parent of i  
        // (path compression)  
        if (subsets[i].parent != i)  
            subsets[i].parent = find(subsets, subsets[i].parent);  
        
        return subsets[i].parent;  
    }  
        
    // A function that does union of two sets of x and y  
    // (uses union by rank)  
    void Union(subset subsets[], int x, int y)  
    {  
        int xroot = find(subsets, x);  
        int yroot = find(subsets, y);  
        
        // Attach smaller rank tree under root of high  
        // rank tree (Union by Rank)  
        if (subsets[xroot].rank < subsets[yroot].rank)  
            subsets[xroot].parent = yroot;  
        else if (subsets[xroot].rank > subsets[yroot].rank)  
            subsets[yroot].parent = xroot;  
        
        // If ranks are same, then make one as root and  
        // increment its rank by one  
        else
        {  
            subsets[yroot].parent = xroot;  
            subsets[xroot].rank++;  
        }  
    }  
        
    // Compare two edges according to their weights.  
    // Used in qsort() for sorting an array of edges  
    int myComp(const void* a, const void* b)  
    {  
        Edge* a1 = (Edge*)a;  
        Edge* b1 = (Edge*)b;  
        return a1->weight > b1->weight;  
    }  
        
    // The main function to construct MST using Kruskal's algorithm  
    void KruskalMST(Graph* graph)  
    {  
        int V = graph->V;  
        Edge result[V]; // Tnis will store the resultant MST  
        int e = 0; // An index variable, used for result[]  
        int i = 0; // An index variable, used for sorted edges  
        
        // Step 1: Sort all the edges in non-decreasing  
        // order of their weight. If we are not allowed to  
        // change the given graph, we can create a copy of  
        // array of edges  
        qsort(graph->edge, graph->E, sizeof(graph->edge[0]), myComp);  
        
        // Allocate memory for creating V ssubsets  
        subset *subsets = new subset[( V * sizeof(subset) )];  
        
        // Create V subsets with single elements  
        for (int v = 0; v < V; ++v)  
        {  
            subsets[v].parent = v;  
            subsets[v].rank = 0;  
        }  
        
        // Number of edges to be taken is equal to V-1  
        while (e < V - 1 && i < graph->E)  
        {  
            // Step 2: Pick the smallest edge. And increment  
            // the index for next iteration  
            Edge next_edge = graph->edge[i++];  
        
            int x = find(subsets, next_edge.src);  
            int y = find(subsets, next_edge.dest);  
        
            // If including this edge does't cause cycle,  
            // include it in result and increment the index  
            // of result for next edge  
            if (x != y)  
            {  
                result[e++] = next_edge;  
                Union(subsets, x, y);  
            }  
            // Else discard the next_edge  
        }  
        
        // print the contents of result[] to display the  
        // built MST  
        cout<<"Following are the edges in the constructed MST\n";  
        for (i = 0; i < e; ++i)  
            cout<<result[i].src<<" -- "<<result[i].dest<<" == "<<result[i].weight<<endl;  
        return;  
    }  
        
    // Driver code 
    int main()  
    {  
        /* Let us create following weighted graph  
                10  
            0--------1  
            | \ |  
        6| 5\ |15  
            | \ |  
            2--------3  
                4 */
        int V = 4; // Number of vertices in graph  
        int E = 5; // Number of edges in graph  
        Graph* graph = createGraph(V, E);  
        
        
        // add edge 0-1  
        graph->edge[0].src = 0;  
        graph->edge[0].dest = 1;  
        graph->edge[0].weight = 10;  
        
        // add edge 0-2  
        graph->edge[1].src = 0;  
        graph->edge[1].dest = 2;  
        graph->edge[1].weight = 6;  
        
        // add edge 0-3  
        graph->edge[2].src = 0;  
        graph->edge[2].dest = 3;  
        graph->edge[2].weight = 5;  
        
        // add edge 1-3  
        graph->edge[3].src = 1;  
        graph->edge[3].dest = 3;  
        graph->edge[3].weight = 15;  
        
        // add edge 2-3  
        graph->edge[4].src = 2;  
        graph->edge[4].dest = 3;  
        graph->edge[4].weight = 4;  
        
        KruskalMST(graph);  
        
        return 0;  
    }  
        
    // This code is contributed by rathbhupendra 
                            
            </pre>
        </div>

        <!-- Complexity -->
        <h4 class="content">Complexity:</h4>
        <p class="content">The Complexity of Kruskal's algorithm is: O( E log V )</p>
        <br>
        <br>


        </div> <!-- col 9 main div  -->
    </div> <!-- row div  -->
</div> <!-- container fluid div  -->

<nav class="navbar navbar-expand-sm bg-success navbar-dark ">
       <h5 class="text-white navbar-center" >@copy Algorithms</h5> 
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