S = [0 1 1 1 0 0;
     1 0 1 1 0 0;
     1 1 0 1 1 1;
     1 1 1 0 1 0;
     0 0 1 1 0 1;
     0 0 1 0 1 0];
% Построение списка смежности из заданной матрицы смежности
[R,C] = find(S); 
% Визуализация графа
N = max(max(R), max(C));
G = sparse(R, C, 1:length(R), N, N);
view(biograph(G, 1:length(R), 'ShowArrows', 'off'))
S = Jakkar(S)

%S = ClearGraf(SixGraf(3));
%[R,C] = find(S);
%N = max(max(R), max(C));
%G = sparse(R, C, 1:length(R), N, N);
%view(biograph(G, 1:length(R), 'ShowArrows', 'off'))