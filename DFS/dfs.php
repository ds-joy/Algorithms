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
    <title>DFS</title>
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
                        <a href="dfs.html">Dfs</a>
                </li>
                <li class="list-group-item"> 
                    <a href="../PRIM/prims.html">Prim's Algorithm</a>
                </li>
                <li class="list-group-item"> 
                    <a href="../Kruskal/kruskal.html">Kruskal's Algorithm</a>
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
            <h1 id="top">Depth First Search</h1>
            <p class="content">
                    The strategy followed by depth-first search is,as its name implies, to search
                    “deeper” in the graph whenever possible. Depth-first search explores edges out
                    of the most recently discovered vertex  that still has unexplored edges leaving it.
                    Once all of v’s edges have been explored, the search “backtracks” to explore edges
                    leaving the vertex from which v was discovered. This process continues until we
                    have discovered all the vertices that are reachable from the original source vertex.
                    If any undiscovered vertices remain, then depth-first search selects one of them as
                    a new source, and it repeats the search from that source. The algorithm repeats this
                    entire process until it has discovered every vertex.
                
            </p>
            

            <p class="content">
                    As in breadth-first search, whenever depth-first search discovers a vertex v during
                    a scan of the adjacency list of an already discovered vertex u, it records this
                    event by setting v’s predecessor attribute v:&#960 to u. Unlike breadth-first search,
                    whose predecessor subgraph forms a tree, the predecessor subgraph produced by
                    a depth-first search may be composed of several trees, because the search may
                    repeat from multiple sources. Therefore, we define the predecessor subgraph of
                    a depth-first search slightly differently from that of a breadth-first search: we let
                    G <sub>&#960</sub> = ( V, E<sub>&#960</sub> ), where
                    E<sub>&#960</sub> = { (V,&#960,v) : v &#8712 V and v.&#960 &#8800 NIL }
               
            </p>
            <p class="content">
                    The predecessor subgraph of a depth-first search forms a depth-first forest comprising
                    several depth-first trees. The edges in E<sub>&#960</sub> are tree edges.
                    As in breadth-first search, depth-first search colors vertices during the search to
                    indicate their state. Each vertex is initially white, is grayed when it is discovered
                    in the search, and is blackened when it is finished, that is, when its adjacency list
                    has been examined completely. This technique guarantees that each vertex ends up
                    in exactly one depth-first tree, so that these trees are disjoint.
                
            </p>
    
            <p class="content">
                    Besides creating a depth-first forest, depth-first search also timestamps each vertex.
                    Each vertex v has two timestamps: the first timestamp v:d records when v
                    is first discovered (and grayed), and the second timestamp v:f records when the
                    search finishes examining v’s adjacency list (and blackens v).
                   
            </p>
            
            <h4 class="content"> Here is an animation explaining Depth First Search: </h4>

            <!--A gif explaining insertion sort  -->
            <div class="anim_container">
                <img src="../Pic/Depth-First-Search.gif" alt="Depth First Search" class="img_anim">
            </div>

            <!-- pseudocode -->
            <h4 class="content"> Here is the pseudocode: </h4>
            <br>
            <div class="font-weight-bold">
            <pre>
        DFS(G,v)   ( v is the vertex where the search starts )
            Stack S := {};   ( start with an empty stack )
            for each vertex u, set visited[u] := false;
            push S, v;
            while (S is not empty) do
                u := pop S;
                if (not visited[u]) then
                    visited[u] := true;
                    for each unvisited neighbour w of u
                        push S, w;
                end if
            end while
            END DFS()
            </pre>
            </div>

            <!-- Code -->
            <h4 class="content"> CODE:</h4>
            <div class="bg-dark content">
            <pre class="text-white">
   
    #include &#60bits/stdc++.h>

    using namespace std;
    
    int vertex;
    int edge;
    int node1;
    int node2;
    vector < int > directed_graph[1000];
    stack < int > stack_data;
    int input_source;
    int counter;
    int flag;
    
    
    int main() {
        cout<<"Enter the number of vertex : ";
        cin>>vertex;
    
        cout<<"Enter the number of edge : ";
        cin>>edge;
    
        for(int i=0;i<edge;i++) {
            cin>>node1>>node2;
            directed_graph[node1].push_back(node2);
        }
    
        cout << endl << endl << "Graph : " << endl;
        for(int i = 1; i < = vertex; i++) {
            cout << i <<" | ";
            for(int j=0 ;j < directed_graph[i].size();j++)
                cout << directed_graph[i][j] << ends;
            cout << endl;
        }
    
        cout << endl << "Input source : ";
        cin >> input_source;
        cout << endl;
        stack_data.push(input_source);
    
        cout << "Path : " << input_source;
        while(!stack_data.empty()) {
            int processing_vertex = stack_data.top();
            stack_data.pop();
            cout << " >> " << processing_vertex;
            if(processing_vertex == input_source) {
                counter++;
                if(counter == 2)
                {
                    flag = 1;
                    break;
                }
            }
    
            for(int j=0; j < directed_graph[processing_vertex].size();j++)
                stack_data.push(directed_graph[processing_vertex][j]);
        }
    
        cout << endl << "Output : ";
        if(flag == 0)
            cout << "No" << endl;
        else
            cout << "Yes" << endl;
    
        return 0;
    
    }
            </pre>
            </div>

        <!-- Complexity -->
        <h4 class="content">Complexity:</h4>
        <p class="content">The Complexity of Depth First Search is: O( | E | )</p>
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