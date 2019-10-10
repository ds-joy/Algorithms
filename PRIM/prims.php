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
    <title>Prim's Algorithm</title>
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
                    <a href="prims.html">Prim's Algorithm</a>
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
            <h1 id="top">Prim's Algorithm</h1>
           
            <p class="content">
                    We have discussed graph algorithms for Minimum Spanning Tree. Like Kruskal’s algorithm, Prim’s algorithm is also a Greedy algorithm. It starts with an empty spanning tree. The idea is to maintain two sets of vertices. The first set contains the vertices already included in the MST, the other set contains the vertices not yet included. At every step, it considers all the edges that connect the two sets, and picks the minimum weight edge from these edges. After picking the edge, it moves the other endpoint of the edge to the set containing MST.
            </p>

            <p class="content">
                    A group of edges that connects two set of vertices in a graph is called cut in graph theory. So, at every step of Prim’s algorithm, we find a cut (of two sets, one contains the vertices already included in MST and other contains rest of the verices), pick the minimum weight edge from the cut and include this vertex to MST Set (the set that contains already included vertices).
            </p>
            <p class="content">
                    The Prim’s Algorithm Works as folloes. The idea behind Prim’s algorithm is simple, a spanning tree means all vertices must be connected. So the two disjoint subsets (discussed above) of vertices must be connected to make a Spanning Tree. And they must be connected with the minimum weight edge to make it a Minimum Spanning Tree.
            </p>
    
           
            <h4 class="content"> Here is an animation explaining  Prim's Algorithm: </h4>

            <!--A gif explaining insertion sort  -->
            <div class="anim_container">
                <img src="../Pic/PrimAlgDemo.gif" alt="Insertion-sort01" class="img_anim">
            </div>

            <!-- pseudocode -->
            <h4 class="content"> Here is the pseudocode: </h4>
            <br>
            <div class="font-weight-bold">
            <pre>
   ReachSet = {0};                    
   UnReachSet = {1, 2, ..., N-1};
   SpanningTree = {};

   while ( UnReachSet ≠ empty )
   {
      Find edge e = (x, y) such that:
         1. x ∈ ReachSet
         2. y ∈ UnReachSet
	 3. e has smallest cost

      SpanningTree = SpanningTree ∪ {e};

      ReachSet   = ReachSet ∪ {y};
      UnReachSet = UnReachSet - {y};
   }
            </pre>
            </div>

            <!-- Code -->
            <h4 class="content"> CODE:</h4>
            <div class="bg-dark content">
            <pre class="text-white">
   
    #include&#60bits/stdc++.h>
    using namespace std;
    
    struct dataElement {
        int node;
        int weight;
            bool operator < (const dataElement& rhs) const {
            return weight > rhs.weight;
        }
    };
    vector < dataElement > List[1000];
    
    int main()
    {
        int vertices,edges;
        int n1,n2,w;
        cin>>vertices>>edges;
        dataElement temp;
    
        for(int i=0; i<edges; i++)
        {
            cin >> n1 >> n2 >> w;
            temp.node = n2; temp.weight = w;
            List[n1].push_back(temp);
            temp.node=n1; temp.weight = w;
            List[n2].push_back(temp);
        }
    
    
        //Prims Algorithm
        priority_queue < dataElement > pq;
        int source = 0;
        vector < int > key(vertices, INT_MAX);
        vector < int > visit(vertices, 0);
        vector < int > parent(vertices, -1);
    
        temp.node=0;
        temp.weight=source;
        pq.push(temp);
        key[source] = 0;
    
        while(!pq.empty())
        {
            int U = pq.top().node;
            pq.pop();
            visit[U] = 1;
    
            for(int i=0; i<List[U].size(); i++)
            {
                int V = List[U][i].node;
                int W = List[U][i].weight;
    
                if(visit[V]==0 && key[V]>W)
                {
                    key[V] = W;
                    temp.node = V; temp.weight = key[V];
                    pq.push(temp);
                    parent[V] = U;
                }
            }
        }
        cout << "Minimum spanning tree : \n";
        for(int i=1; i < vertices; i++)
            cout << "\t" << parent[i] << "-"<< i << endl;
        cout << endl;
    
        return 0;
    }
    
    
            
            </pre>
        </div>

        <!-- Complexity -->
        <h4 class="content">Complexity:</h4>
        <p class="content">The Complexity of Prim's algorithm using adjacency matrix is: O( |V| <sup>2</sup> )</p>
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