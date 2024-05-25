def spiralOrder(matrix):
    result = []
    if not matrix:
        return result

    left, right = 0, len(matrix[0]) - 1
    top, bottom = 0, len(matrix) - 1

    while left <= right and top <= bottom:
        if top <= bottom:
            for i in range(left, right + 1):
                result.append(matrix[top][i])
            top += 1

        if left <= right:
            for i in range(top, bottom + 1):
                result.append(matrix[i][right])
            right -= 1
    
        # Traverse from right to left along the bottom row (if still within bounds)
        if top <= bottom:
            for i in range(right, left - 1, -1):
                print(i)
                result.append(matrix[bottom][i])
            bottom -= 1

        # Traverse from bottom to top along the left column (if still within bounds)
        if left <= right:
            for i in range(bottom, top - 1, -1):
                result.append(matrix[i][left])
            left += 1

    return result

# Example usage:
matrix = [
    [1, 2, 3, 4, 5],
    [6, 7, 8, 9, 10],
    [11, 12, 13, 14, 15],
    [16, 17, 18, 19, 20],
    [21, 22, 23, 24, 25]
]


print(spiralOrder(matrix))
