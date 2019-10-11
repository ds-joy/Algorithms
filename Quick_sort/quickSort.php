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
    <title>Quick Sort</title>
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
                    <a href="quickSort.html">Quick Sort</a>
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
                    <a href="../KnapsackGreedy/knapsackGreedy.html">Knapsack(Greedy)</a>
                </li>
            </ul>
        </div> <!--col-3.. main div-->
        <div class="col-9 main ">
            <h1 id="top">Quick Sort</h1>
            <p class="content">
                    The quicksort algorithm has a worst-case running time of O( n <sup>2</sup> ) on an input array
                    of n numbers. Despite this slow worst-case running time, quicksort is often the best
                    practical choice for sorting because it is remarkably efficient on the average: its
                    expected running time is O(nlogn), and the constant factors hidden in the O(nlogn)
                    notation are quite small. It also has the advantage of sorting in place, and it works well even in virtual-memory environments.
            </p>

            <p class="content">
                The quick sort algorithm uses the divide and conqure method to sort the array. A Divide and Conquer algorithm has the major parts.
                <ol class="content">
                    <li>Divide</li>
                    <li>Conqure</li>
                    <li>Combine</li>
                </ol>
            </p>

            <p class="content">
                In the divide part the quick sort algorithm uses an approach of partitioning the array. The partition function takes one element and puts it its appropriate place and divides the array in two parts. One part is less than the inplaced array element and the other pard is greater.
                
            </p>

            <p class="content">
                The quick sort function uses the partition algorithm to divide the array into two halves. This process continues untill all array elements are in place.
            </p>
            
            <h4 class="content"> Here is an animation explaining Quick Sort: </h4>

            <!--A gif explaining insertion sort  -->
            <div class="anim_container">
                <img src="../Pic/Quicksort-example.gif" alt="Insertion-sort01" class="img_anim">
            </div>

            <!-- pseudocode -->
            <h4 class="content"> Here is the pseudocode: </h4>
            <br>
            <div class="font-weight-bold">
            <pre>
                quickSort(A, lo, hi) is
                if lo < hi then
                p := partition(A, lo, hi)
                quicksort(A, lo, p - 1)
                quicksort(A, p + 1, hi)

                partition(A, lo, hi) is
                pivot := A[hi]
                i := lo
                for j := lo to hi do
                    if A[j] < pivot then
                        swap A[i] with A[j]
                        i := i + 1
                swap A[i] with A[hi]
                return i
            </pre>
            </div>

            <!-- Code -->
            <h4 class="content"> CODE:</h4>
            <div class="bg-dark content">
            <pre class="text-white">
   
    #include &#60iostream>
    using namespace std;
        
    int data_array[100000];
    int temporary;

    //here we are using a global array so we
    //don't have to pass it as an argument

    int partition(int start, int stop);
    void quickSort(int start, int stop);

    int main() {
        int array_size;
        cout << "Enter array size : ";
        cin >> array_size;

        cout << endl << "Data Array : ";
        for(int i = 0 ; i < array_size; i++) {
            data_array[i]=rand()%100;
            cout << data_array[i] << ends;
        }
        cout << endl;

        quickSort(0, array_size-1);

        cout << endl << "Sorted_array : ";
        for(int i=0 ;i < array_size;i++)
            cout << data_array[i] << ends;
        cout << endl;

        return 0;
    }

    int partition(int start, int stop) {
        int pivot = data_array[start];
        int i = stop+1;
        for(int j=stop;j>start;j--) {
            if(pivot < data_array[j]) {
                i--;
                temporary = data_array[i];
                data_array[i]=data_array[j];
                data_array[j]=temporary;
            }
        }
        i--;
        temporary = data_array[i];
        data_array[i]=data_array[start];
        data_array[start]=temporary;
        return i;
    }

    void quickSort(int start, int stop) {
        if(start < stop) {
            int position = partition(start, stop);
            quickSort(start, position-1);
            quickSort(position+1, stop);
        }
    }
                     
     </pre>
        </div>

        <!-- Complexity -->
        <h4 class="content">Complexity:</h4>
        <p class="content">The Complexity of Quick Sort is: O( nlogn )</p>
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