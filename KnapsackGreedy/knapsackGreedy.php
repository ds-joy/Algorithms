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
    <title>Knapsack Greedy</title>
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
                    <a href="../Kruskal/kruskal.html">Kruskal's Algorithm</a>
                </li>
                <li class="list-group-item"> 
                    <a href="../KnapsackBruteForce/KnapsackBrute.html">Knapsack Brute Force</a>
                </li>

                <li class="list-group-item"> 
                    <a href="knapsackGreedy.html">Knapsack(Greedy)</a>
                </li>
            </ul>
        </div> <!--col-3.. main div-->
        <div class="col-9 main ">
            <h1 id="top">Knapsack Problem Greedy</h1>
            <p class="content">
                    Among all the algorithmic approaches, the simplest and straightforward approach is the Greedy method. In this approach, the decision is taken on the basis of current available information without worrying about the effect of the current decision in future.
            </p>

            <p class="content">
                    Greedy algorithms build a solution part by part, choosing the next part in such a way, that it gives an immediate benefit. This approach never reconsiders the choices taken previously. This approach is mainly used to solve optimization problems. Greedy method is easy to implement and quite efficient in most of the cases. Hence, we can say that Greedy algorithm is an algorithmic paradigm based on heuristic that follows local optimal choice at each step with the hope of finding global optimal solution.
            </p>
            <p class="content">
                    An efficient solution to the  is to use Greedy approach. The basic idea of the greedy approach is to calculate the ratio value/weight for each item and sort the item on basis of this ratio. Then take the item with the highest ratio and add them until we can’t add the next item as a whole and at the end add the next item as much as we can. Which will always be the optimal solution to this problem.
            </p>
    
            <p class="content">
                  The main concern in this algorithm is to sort the array. The complexity of the algorithm will be same as the complexity of the sorting algorithm. As we are going to use the quick sort our complexity will be nlogn.  
            </p>
            
            

            <!-- pseudocode -->
            <h4 class="content"> Here is the pseudocode: </h4>
            <br>
            <div class="font-weight-bold">
            <pre>
                    
            1.Sort the array by profit
            2.check if the weight 
              limit is being crossed
            3.If not add the weight to 
              bag_weight
            4.add profit to total_profit
        
            </pre>
            </div>

            <!-- Code -->
            <h4 class="content"> CODE:</h4>
            <div class="bg-dark content">
            <pre class="text-white">
   
    // C/C++ program to solve fractional Knapsack Problem 
    #include &#60bits/stdc++.h> 
    using namespace std; 
        
    // Structure for an item which stores weight and corresponding 
    // value of Item 
    struct Item { 
        int value, weight; 
        
        // Constructor 
        Item(int value, int weight) : value(value), weight(weight) {} 
    }; 
        
    // Comparison function to sort Item according to val/weight ratio 
    bool cmp(struct Item a, struct Item b) { 
        double r1 = (double)a.value / a.weight; 
        double r2 = (double)b.value / b.weight; 
        return r1 > r2; 
    } 
        
    // Main greedy function to solve problem 
    double fractionalKnapsack(int W, struct Item arr[], int n) { 
        //    sorting Item on basis of ratio 
        sort(arr, arr + n, cmp); 
        
        //    Uncomment to see new order of Items with their ratio 
        /* 
        for (int i = 0; i < n; i++) { 
            cout << arr[i].value << "  " << arr[i].weight << " : " 
                    << ((double)arr[i].value / arr[i].weight) << endl; 
        } 
        */
        
        int curWeight = 0;  // Current weight in knapsack 
        double finalvalue = 0.0; // Result (value in Knapsack) 
        
        // Looping through all Items 
        for (int i = 0; i < n; i++) { 
            // If adding Item won't overflow, add it completely 
            if (curWeight + arr[i].weight <= W) { 
                curWeight += arr[i].weight; 
                finalvalue += arr[i].value; 
            } 
        
            // If we can't add current Item, add fractional part of it 
            else { 
                int remain = W - curWeight; 
                finalvalue += arr[i].value * ((double) remain / arr[i].weight); 
                break; 
            } 
        } 
        
        // Returning final value 
        return finalvalue; 
    } 
        
    // driver program to test above function 
    int main() { 
        int W = 50;   //    Weight of knapsack 
        Item arr[] = {{60, 10}, {100, 20}, {120, 30}}; 
        
        int n = sizeof(arr) / sizeof(arr[0]); 
        
        cout << "Maximum value we can obtain = "
                << fractionalKnapsack(W, arr, n); 
        return 0; 
    } 
                            
            </pre>
        </div>

        <!-- Complexity -->
        <h4 class="content">Complexity:</h4>
        <p class="content">The Complexity of Knapsack Greedy algorithm is : O( nlogn )</p>
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