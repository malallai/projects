/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_newarray.c                                      :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/01/09 17:34:45 by malallai          #+#    #+#             */
/*   Updated: 2019/01/13 13:39:33 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "libft.h"

char	**ft_newarray(size_t size1, size_t size2, char m)
{
	char	**new_array;
	size_t	i;

	i = 0;
	if ((new_array = (char **)malloc(sizeof(char **) * size1)))
	{
		while (i < size2)
		{
			if (!(new_array[i] = ft_strnew(size2)))
				return (NULL);
			ft_memset(new_array[i], m, size2);
			i++;
		}
		new_array[i] = 0;
	}
	else
		return (NULL);
	return (new_array);
}
